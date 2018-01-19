#!/usr/bin/python

import code
import sys
import time
import sqlite3

import Adafruit_DHT
from SoundSensor import SoundSensor
from MCP3008ADC import MCP3008ADC

import RPi.GPIO as GPIO
from datetime import datetime
from pytz import timezone

### Vars
duratiuon = 2

# DHT Pins
sensorDHT = 22
pinDHT    = 26

# Sound Sensor Pins and Declarations
pinGate = 21
pinEnvelope = 1
pinAudio = 0

GPIO.setmode(GPIO.BCM)
GPIO.setup(pinGate, GPIO.IN)

myMCP = MCP3008ADC()
mySoundSensor = SoundSensor(pinGate, pinEnvelope, pinAudio)

def embed():
    vars = globals()
    vars.update(locals())
    shell = code.InteractiveConsole(vars)
    shell.interact()

conn = sqlite3.connect('data.db')

if __name__ == '__main__':
    #embed()

    while True:
        tmp, hum = Adafruit_DHT.read_retry(sensorDHT, pinDHT)

        print('Temperature: {}, Humidity: {}'.format(tmp, hum))

        with conn:
            c = conn.cursor()
            c.execute('INSERT INTO temp (Value) VALUES (?)', (tmp, ))
            c.execute('INSERT INTO hum (Value) VALUES (?)', (hum, ))

        gateVal = GPIO.input(mySoundSensor.gate)
        envelopeVal = myMCP.read(mySoundSensor.envelope)
        audioVal = myMCP.read(mySoundSensor.audio)

        sound_entry = {'gate': gateVal, 'envelope': envelopeVal, 'audio': audioVal}

        with conn:
            c = conn.cursor()
            sql = 'INSERT INTO sound (Gate, Envelope, Audio) VALUES (:gate, :envelope, :audio)'
            c.execute(sql, sound_entry)
        
        time.sleep(1)
