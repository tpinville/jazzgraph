import json
import urllib

API_KEY = 'AIzaSyB25GR3w5JrMCZuDl5Ad6pMFB_9pa7_NSw'
service_url = 'https://www.googleapis.com/freebase/v1/mqlread'
query = {'type':'/music/artist','name':'John Coltrane','album':[]
      }
params = {
      'key': API_KEY,
        'query': json.dumps(query)
        }
url = service_url + '?' + urllib.urlencode(params)
response = json.loads(urllib.urlopen(url).read())
print response
