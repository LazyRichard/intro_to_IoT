#!/usr/bin/env python3

import sys
import wiringpi

PIN_LED_RED = 22
PIN_LED_GREEN = 27
PIN_LED_BLUE = 17

LED_PWM_MIN = 0
LED_PWM_MAX = 100

class LEDController:
    def __init__(self, pin_red=None, pin_green=None, pin_blue=None):
        self._pin_red = PIN_LED_RED if pin_red is None else pin_red
        self._pin_green = PIN_LED_GREEN if pin_green is None else pin_green
        self._pin_blue = PIN_LED_BLUE if pin_blue is None else pin_blue
    
        wiringpi.wiringPiSetupGpio()
        wiringpi.pinMode(self._pin_red, wiringpi.OUTPUT)
        wiringpi.pinMode(self._pin_green, wiringpi.OUTPUT)
        wiringpi.pinMode(self._pin_blue, wiringpi.OUTPUT)

        wiringpi.softPwmCreate(self._pin_red, LED_PWM_MIN, LED_PWM_MAX)
        wiringpi.softPwmCreate(self._pin_green, LED_PWM_MIN, LED_PWM_MAX)
        wiringpi.softPwmCreate(self._pin_blue, LED_PWM_MIN, LED_PWM_MAX)

    def write(self, color):
        wiringpi.softPwmWrite(self._pin_red, 255 - int("{}{}".format("0x", color[0:2]), 16))
        wiringpi.softPwmWrite(self._pin_green, 255 - int("{}{}".format("0x", color[2:4]), 16))
        wiringpi.softPwmWrite(self._pin_blue, 255 - int("{}{}".format("0x", color[4:]), 16))

if __name__ == '__main__':
    led = LEDController()

    print(sys.argv[1:])
    led.write(''.join(sys.argv[1:]))
