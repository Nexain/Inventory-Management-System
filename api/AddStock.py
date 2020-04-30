from time import sleep
import sys
# from mfrc522 import SimpleMFRC522
# reader = SimpleMFRC522()
# tambahan
import httplib2
import json

address = 'http://localhost:5000'
wh_id = "BDG"

try:
    # while(1):
        print("Hold a tag near the reader")
        #   id, text = reader.read()
        id = "10"
        text = "FP0002"
        print("ID: %s\nText: %s" % (id,text))

        # Making a POST Request /increase
        print ("Making a POST request to /api/wh-log/increase-stock...")
        try:
            url = address + "/api/wh-log/increase-stock?tag_id=%s&product_id=%s&wh_id=%s" % (id, text, wh_id)
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
    # GPIO.cleanup()
    raise