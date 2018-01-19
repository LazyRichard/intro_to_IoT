class SoundSensor:
    def __init__(self, gate, envelope, audio):
        self._gate = gate
        self._envelope = envelope
        self._audio = audio

    @property
    def gate(self):
        return self._gate

    @gate.setter
    def gate(self, val):
        self._gate = val

    @property
    def envelope(self):
        return self._envelope

    @envelope.setter
    def envelope(self, val):
        self._envelope = val

    @property
    def audio(self):
        return self._audio

    @audio.setter
    def audio(self, val):
        self._audio = val
