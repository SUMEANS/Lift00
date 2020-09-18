import time
from selenium import webdriver

driver = webdriver.Chrome("C:/Users/samsung/sibar/ddri.exe")
driver.get("http://172.31.236.149/curl_send.php")
time.sleep(2)
driver.close()
