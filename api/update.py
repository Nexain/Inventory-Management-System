import requests

url = 'http://192.168.0.10/mockup/items/update'
data = {
"TAG_ID": "12" 
}

x = requests.put(url, json=data)

print(x.text)
