from Adafruit_MCP3008 import MCP3008
import Adafruit_GPIO.SPI as SPI

class MCP3008ADC:
    def __init__(self):
        self._mcp = MCP3008(spi = SPI.SpiDev(0, 0))

    def read(self, pin_num):
        val = self._mcp.read_adc(pin_num)

        return int(val)
