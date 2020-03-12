#!/usr/bin/env python

from time import sleep
import sys
from mfrc522 import SimpleMFRC522
reader = SimpleMFRC522()

try:
    while(1):
        print("Hold a tag near the reader")
        id, text = reader.read()
        print("ID: %s\nText: %s" % (id,text))

except KeyboardInterrupt:
    GPIO.cleanup()
    raise
