import time
from selenium import webdriver

driver = webdriver.Chrome("C:/Users/samsung/sibar/ddri.exe")
driver.get("http://172.20.87.65/curl_send.php")
time.sleep(2)
driver.close()
