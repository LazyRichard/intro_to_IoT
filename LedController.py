from wiringpi import wiringpi

PIN_LED_RED = 22
PIN_LED_GREEN = 27
PIN_LED_BLUE = 17

LED_PWM_MIN = 0
LED_PWM_MAX = 255

class LEDController:
    def __init__(self, wringpi_obj, pin_red=None, pin_green=None, pin_blue=None):
        self._wiringpi_obj = wiringpi_obj

        self._pin_red = PIN_LED_RED if pin_red is None else pin_red
        self._pin_green = PIN_LED_GREEN if pin_green is None else pin_green
        self._pin_blue = PIN_LED_BLUE if pin_blue is None else pin_blue

        self._wiringpi_obj.pinMode(self._pin_red, wiringpi.OUTPUT)
        self._wiringpi_obj.pinMode(self._pin_green, wiringpi.OUTPUT)
        self._wiringpi_obj.pinMode(self._pin_blue, wiringpi.OUTPUT)

        self._wiringpi_obj.softPwmCreate(self._pin_red, LED_PWM_MIN, LED_PWM_MAX)
        self._wiringpi_obj.softPwmCreate(self._pin_green, LED_PWM_MIN, LED_PWM_MAX)
        self._wiringpi_obj.softPwmCreate(self._pin_blue, LED_PWM_MIN, LED_PWM_MAX)

    def write(color):
        self._wiringpi_obj.softPwmWrite(self._pin_red, color[0:2])
        self._wiringpi_obj.softPwmWrite(self._pin_green, color[2:4])
        self._wiringpi_obj.softPwmWrite(self._pin_blue, color[4:])