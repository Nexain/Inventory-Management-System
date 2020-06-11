#!/usr/bin/env python

import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522

reader = SimpleMFRC522()

try:
    text = input('New data:')
    while(1):
        print("Now place your tag to write")
        reader.write(text)
        print("Written")
except KeyboardInterrupt:
	print("Interrupted")
finally:
	GPIO.cleanup()
	GPIO.setwarnings(False)
