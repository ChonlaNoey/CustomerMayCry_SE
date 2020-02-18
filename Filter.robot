*** Settings ***

Library    SeleniumLibrary

*** Variables ***

${HOMEPAGE_URL}   http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/testing/
${LIST_URL}   http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/testing/list.php
${BROWSER}    Chrome

*** Test Cases ***

Open Browser  
    Open Browser    ${LIST_URL}    ${BROWSER}
	
TS01 TC01
    Select Checkbox    ไม่ได้ระบุ
	
TS01 TC02
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	
TS01 TC03
    Go To    ${LIST_URL}
    Select Checkbox    แล็ปท็อป
	
TS01 TC04
    Go To    ${LIST_URL}
	Select Checkbox    โดรน

TS01 TC05
    Go To    ${LIST_URL}	
	Select Checkbox    แท็บเล็ต
	
TS01 TC06
    Go To    ${LIST_URL}
    Select Checkbox    กล้องโกโปร
	
TS01 TC07
    Go To    ${LIST_URL}
    Select Checkbox    คอมพิวเตอร์
	
TS01 TC08
    Go To    ${LIST_URL}
    Select Checkbox    ไม่ได้ระบุ
	
TS01 TC09
    Go To    ${LIST_URL}
    Select Checkbox    สามารถพกพาได้

TS01 TC10
    Go To    ${LIST_URL}
    Select Checkbox    ไม่สามารถพกพาได้
	
TS01 TC11
    Go To    ${LIST_URL}
    Select Checkbox    ห้องเก็บของ
	
TS01 TC12
    Go To    ${LIST_URL}
    Select Checkbox    อยู่กับผู้ยืม

TS01 TC13
    Go To    ${LIST_URL}
    Select Checkbox    ส่งซ่อม

TS01 TC14
    Go To    ${LIST_URL}
    Select Checkbox    SC8104
	
TS01 TC15
    Go To    ${LIST_URL}
    Select Checkbox    ว่าง
  
TS01 TC16
    Go To    ${LIST_URL}
    Select Checkbox    ถูกยืม
 
TS01 TC17
    Go To    ${LIST_URL}
    Select Checkbox    กำลังซ่อม
	
TS02 TC18
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	Select Checkbox    สามารถพกพาได้

TS02 TC19
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	Select Checkbox    ห้องเก็บของ

TS02 TC20
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	Select Checkbox    ว่าง
	
TS02 TC21
    Go To    ${LIST_URL}
    Select Checkbox   ไม่สามารถพกพาได้
	Select Checkbox    อยู่กับผู้ยืม
	
TS02 TC22
    Go To    ${LIST_URL}
    Select Checkbox    ไม่สามารถพกพาได้
	Select Checkbox    ถูกยืม
	
TS02 TC23
    Go To    ${LIST_URL}
    Select Checkbox    ห้องเก็บของ
	Select Checkbox    ว่าง
	
TS03 TC24
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	Select Checkbox    สามารถพกพาได้
	Select Checkbox    ห้องเก็บของ
	
TS03 TC25
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	Select Checkbox    สามารถพกพาได้
	Select Checkbox    ถูกยืม
	
TS03 TC26
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	Select Checkbox    ห้องเก็บของ
	Select Checkbox    ว่าง
	
TS03 TC27
    Go To    ${LIST_URL}
    Select Checkbox    ไม่สามารถพกพาได้
	Select Checkbox    อยู่กับผู้ยืม
	Select Checkbox    ว่าง
	
TS04 TC28
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	Select Checkbox    สามารถพกพาได้
	Select Checkbox    ห้องเก็บของ
	Select Checkbox    ว่าง
	
TS05 TC29
    Go To    ${LIST_URL}
    Select Checkbox    ไม่สามารถพกพาได้
	Select Checkbox    สามารถพกพาได้
	
TS06 TC30
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	Select Checkbox    ไม่ได้ระบุ
	Select Checkbox    แล็ปท็อป
	Select Checkbox    โดรน
	Select Checkbox    แท็บเล็ต
	Select Checkbox    กล้องโกโปร
	Select Checkbox    คอมพิวเตอร์
	Select Checkbox    ไม่สามารถพกพาได้
	Select Checkbox    สามารถพกพาได้
	Select Checkbox    ห้องเก็บของ
	Select Checkbox    อยู่กับผู้ยืม
	Select Checkbox    ส่งซ่อม
	Select Checkbox    SC8104
	
TS07 TC31
    Go To    ${LIST_URL}
    Select Checkbox    สมาร์ทโฟน
	Select Checkbox    ไม่สามารถพกพาได้
	Wait Until Page Contains    ไม่พบข้อมูล
	
TS07 TC32
    Go To    ${LIST_URL}
    Select Checkbox    คอมพิวเตอร์
	Select Checkbox    สามารถพกพาได้
	Wait Until Page Contains    ไม่พบข้อมูล
	
TS08 TC33
    Go To    ${LIST_URL}

[Teardown]    Close Browser