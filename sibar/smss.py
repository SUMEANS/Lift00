import time
from selenium import webdriver

driver = webdriver.Chrome("C:/Users/samsung/sibar/ddri.exe")
driver.get("http://172.24.185.69/curl_send.php")
time.sleep(2)
driver.close()
