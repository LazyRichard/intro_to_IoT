#!/usr/bin/python

import code
import sys
import time

import Adafruit_DHT
from SoundSensor import SoundSensor
from MCP3008ACD import MCP3008ADC

import RPi.GPIO as GPIO
from datetime import datetime
from pytz import timezone

def embed():
    vars = globals()
    vars.update(locals())
    shell = code.InteractiveConsole(vars)
    shell.interact()

if __name__ == '__main__':
    embed()
