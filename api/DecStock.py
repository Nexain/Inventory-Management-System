import sys
import RPi.GPIO as GPIO
# tambahan
import httplib2
import json

from mfrc522 import SimpleMFRC522
reader = SimpleMFRC522()

GPIO.cleanup()
GPIO.setwarnings(False)

address = 'http://192.168.0.11:5000'
wh_id = "BDG"

try:
    # while(1):
        wh_id = input("Input Warehouse ID: ")
        print("Hold a tag near the reader")
        id, text = reader.read()
        #id = "1"
        #text = "FP0002"
        print("ID: %s\nText: %s" % (id,text))

        #Making a PUT Request /decrease
        print ("Making PUT requests to /api/wh-log/decrease-stock...")
        try:
            url = address + "/api/wh-log/decrease-stock?tag_id=%s" % id
            h = httplib2.Http()
            resp, result = h.request(url, 'PUT')
            if resp['status'] != '200':
                raise Exception('Received an unsuccessful status code of %s' % resp['status'])

        except Exception as err:
            print ("Test 4 FAILED: Could not make PUT Request to web server")
            print (err.args)
            sys.exit()
        else:
            print ("Test 4 PASS: Succesfully Made PUT Request to /api/wh-log/decrease-stock")

except KeyboardInterrupt:
    print("Keyboard interrupt")

finally:
    GPIO.cleanup()
