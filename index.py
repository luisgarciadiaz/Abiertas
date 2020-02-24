# Creado por LAGD
#Version 1
#a partir de la base de datos abiertos(id,toriginal,tnuevo) cambia los datos encontrados que coincidan

import MySQLdb
from time import time
import funciones as ff  # archivo de funciones funtion file

tti=time()
db = MySQLdb.connect(host="localhost",
                    user="root",
                   passwd="",
                      db="Tracking")
camAbi=["11_42_R","11_43_R","13_60_R"] #campos abiertos
sql = "SELECT "
for i in range(len(camAbi)):
    sql+=camAbi[i]+","
sql = sql[:-1]
sql+=" FROM bdv WHERE 12_44_R <> ''"
sql2 = "SELECT * FROM abiertos" #obten la tabla de equivalencias
cursor = db.cursor()
cursor2 = db.cursor()
cursor.execute(sql)
cursor2.execute(sql2)
records = cursor.fetchall()
records2 = cursor2.fetchall()
#print("todos records:")
#print(records)
print("todos las equivalencias:")
print(records2)
for i in range(len(records2[0])):
    print("****************")
    sql="SELECT id,11_42_R FROM bdv WHERE 11_42_R='"+records2[i][1]+"'"
    print(sql)
    cursor2.execute(sql)
    records3 = cursor2.fetchall()
    print("resultados de encontradas con equivalencias:")
    print(records3)
    datos=[]
    for x in range(len(records3)):
        #dato=[]
        #dato.append(records2[i][2])
        #dato.append(str(records3[x][0]))
        #datos.append(dato)
        #cursor2.executemany("UPDATE dbv SET 11_42_R=? WHERE id=?",datos)
        sql = "UPDATE bdv set 11_42_R='" + records2[i][2] + "' WHERE ID='"+str(records3[x][0])
        print("SQL:")
        print(sql)
        cursor2.execute(sql)

    #print(datos)
print("****************")
db.close()
ttf=time()
ttt=ttf-tti
print("tiempo total del proceso:"+str(ttt))