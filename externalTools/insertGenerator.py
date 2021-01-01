import re
import os

dirname = os.path.dirname(__file__)
filename = os.path.join(dirname, 'demofile.txt')
regex = r"CREATE.*[\s\S]*?COLLATE=utf8mb4_unicode_ci;"
f = open(filename, "r")
#print(f.read())
txt = f.read()
sqlDDL = re.findall(regex,txt)
regex = r"`.*?,"
insertStatement = "INSERT INTO " 
for sql in sqlDDL: #each create statement
    titlePattern = r"`.*?`"
    title = re.findall(titlePattern,sql)
    insertStatement = "INSERT INTO " + title[0] + " ("
    properties = re.findall(regex,sql)
    for ele in properties:
        pattern = r"`.*?`"
        x = re.search(pattern, ele)
        insertStatement = insertStatement + x.group() + ","
    insertStatement = insertStatement[:-1]
    insertStatement += ") VALUES ();"
    print(insertStatement)



