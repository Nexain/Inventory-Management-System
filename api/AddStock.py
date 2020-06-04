import sys
import RPi.GPIO as GPIO
# tambahan
import httplib2
import json

from mfrc522 import SimpleMFRC522
reader = SimpleMFRC522()

address = 'http://192.168.43.205:5000/api/wh-log/increase-stock?tag_id='
wh_id = "BDG"

try:
    # while(1):
        wh_id = input("Input Warehouse ID: ")
        print("Hold a tag near the reader")
        id, text = reader.read()
        # id = "10"
        # text = "FP0002"
        tag_id = str(id)
        product_id = text[0:6]
        print("TAG ID: %s\nPRODUCT ID: %s" % (tag_id, product_id))

        # Making a POST Request /increase
        print ("Making a POST request to /api/wh-log/increase-stock...")
        try:
            url = address + tag_id + "&product_id=" + product_id + "&wh_id=" + wh_id
            h = httplib2.Http()
            resp, result = h.request(url, 'POST')
            obj = json.loads(result)
            if resp['status'] != '200':
                raise Exception('Received an unsuccessful status code of %s' % resp['status'])

        except Exception as err:
            print ("Test 1 FAILED: Could not make POST Request to web server")
            print (err.args)
            sys.exit()
        else:
            print ("Test 1 PASS: Succesfully Made POST Request to /api/wh-log/increase-stock")

except KeyboardInterrupt:
    print("Keyboard interrupt")

finally:
    GPIO.cleanup()