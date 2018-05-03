import re

def loadCountryMap(map):
    file = open('sqlTuples/countryMap.sql', 'r')
    #newEvent = open('countries.sql', 'w')

    file.readline()
    idx = 0
    while True:
        idx = idx + 1
        line = file.readline()

        if len(line) == 0:
            break

        m = re.search('.*\(\'([\w\s]+).*', line)
        #print(idx, end='')
        # print(' => ' + m.group(1))
       
        key = m.group(1)
        print(key + ": " + str(len(key)))
        value = idx
        map[key] = value
        #sqlFile.write("INSERT INTO country(name) VALUES('" + str + "');\n")

    #sqlFile.close()
    file.close()

def eventParser(countryCodes):
    oldFile = open('sqlTuples/events.sql', 'r')
    newFile = open('sqlTuples/newEvents.sql', 'w')
    
    print("Dict Keys: %s" % countryCodes.keys())

    while True:
        line = oldFile.readline()

        if(len(line) == 0):
            break

        m = re.search('(.*,)(.*)(,.*,.*,.*,.*,.*)', line)
        country = m.group(2)
        country = country[2:-1]

        newFile.write(m.group(1) + ' ') 

        print("Country: " + country + " ", end='')

        # print(str(countryCodes[country]))
        if country in countryCodes.keys():
            foreignKey = str(countryCodes[country])
            print(' => ' + foreignKey)
            newFile.write(foreignKey + ' ') 
        else:
            #print(country)
            print('ERROR')
            newFile.write("ERROR")
        
        newFile.write(m.group(3) + '\n') 
    
    oldFile.close()
    newFile.close()


#countryPopulate()
countryCodes = {}
loadCountryMap(countryCodes)

# for keys,values in countryCodes.items():
#     print(keys + " => ", end="")
#     print(values) 
# exit(0)

eventParser(countryCodes)
