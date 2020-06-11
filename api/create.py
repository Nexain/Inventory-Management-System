import requests

url = 'http://192.168.0.10/mockup/items/create'
data = {
"TAG_ID": "12",
"PRODUCT_ID": "FP0001",
"WH_ID": "BDG"
}

x = requests.post(url, json=data)

print(x.text)
