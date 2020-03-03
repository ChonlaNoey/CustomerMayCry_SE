*** Settings ***

Library    SeleniumLibrary

*** Variables ***

${HOMEPAGE_URL}   http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/
${BROWSER}    chrome
${emailVS}    pornpimol_p@kkumail.com
${passVS}    Pimol123
${emailVE}    paweena@kku.ac.th
${passVE}    Pawee321

*** Test Cases ***

TC001 Open Register page  
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php

	
TC002 Select Register Student
    Select Radio Button    status    student
    Click Button    btn-submit
	Location Should Be    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_form_student.php
	Close Browser
	

TC003 Select Register Staff
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
    Select Radio Button    status    staff
    Click Button    btn-submit 	
	Location Should Be    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_form_staff.php
	
TC004 Not Select
    Click Button    ย้อนกลับ
	Close Browser

TC005 Open Register Staff page  
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php

TC006 Valid Register Staff 
    Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    ลงทะเบียนสำเร็จ 
	Close Browser

TC007 Open Register Staff page  
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php

TC008 Invalid Name 
    Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    456879
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    ข้อมูลไม่ถูกต้อง

TC009 Invalid Name(Eng
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    Paweena
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    ข้อมูลไม่ถูกต้อง

TC010 Invalid Name(SpecailChar)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณ)
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    ข้อมูลไม่ถูกต้อง

TC011 Invalid Name(Emtpy)
    Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit 
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกชื่อ
	Reload Page

TC012 Invalid LastName 
    Input Text    fname    ประวีณา
	Input Text    lname    123456
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    ข้อมูลไม่ถูกต้อง
	
TC013 Invalid LastName(Eng)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit 
    Input Text    fname    ประวีณา
	Input Text    lname    Uying
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    ข้อมูลไม่ถูกต้อง
	
TC014 Invalid LastName(SpecailChar)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    ข้อมูลไม่ถูกต้อง
	
TC015 Invalid LastName(Emtpy)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกนามสกุล
	Reload Page

TC016 Invalid Email
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    songchan@gmail.com
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    ข้อมูลไม่ถูกต้อง

TC017 Invalid Email(No@)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweenakku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง
	
TC018 Invalid Email(@kkumail)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kkumail.com
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง

TC019 Invalid Email(Emtpy)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกอีเมล
	Reload Page

TC020 Invalid Password
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee3
	Input Text    confirm    Pawee3
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง
	
TC021 Invalid Password(LessThan8)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee12
	Input Text    confirm    Pawee12
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง
	
TC022 Invalid Password(MoreThan8)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321654987U
	Input Text    confirm    Pawee321654987U
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง

TC023 Invalid Password(SmallChar)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    pawee321
	Input Text    confirm    pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง
	
TC024 Invalid Password(LargeChar)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    PAWEE321
	Input Text    confirm    PAWEE321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง
	
TC025 Invalid Password(NoNum)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    PaweenaU
	Input Text    confirm    PaweenaU
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง
	
TC026 Invalid Password(NoChar)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    32165423
	Input Text    confirm    32165423
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง

TC027 Invalid Password(Empty)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกรหัสผ่านให้ถูกต้อง
	Reload Page

TC028 Invalid Con-Password(Empty)
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกรหัสผ่านให้ถูกต้อง
	Reload Page

TC029 Invalid Position(Empty)
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Click Button    btn-submit
	Wait Until Page Contains     กรุณากรอกที่อยู่ 
	Reload Page

TC030 Invalid PhoneNum
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-*06-2@55
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง
	
TC031 Invalid PhoneNum(LessThan10)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-235
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง
	
TC032 Invalid PhoneNum(MoreThan10)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-23655
	Click Button    btn-submit
	Wait Until Page Contains     ข้อมูลไม่ถูกต้อง
	
TC033 Invalid PhoneNum(Emtpy)
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	Select Radio Button    status    staff
    Click Button    btn-submit
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Click Button    btn-submit
	Wait Until Page Contains     กรุณากรอกเบอร์โทรศัพท์ 	
	
TC034 Invalid All(Empty)
	Click Button    btn-submit
	Wait Until Page Contains     กรุณากรอกชื่อ
	Wait Until Page Contains     กรุณากรอกนามสกุล
	Wait Until Page Contains     กรุณากรอกอีเมล
	Wait Until Page Contains     กรุณากรอกรหัสผ่านให้ถูกต้อง
	Wait Until Page Contains     กรุณากรอกรหัสผ่านให้ถูกต้อง
	Wait Until Page Contains     กรุณากรอกที่อยู่
	Wait Until Page Contains     กรุณากรอกเบอร์โทรศัพท์
 
TC035 Invalid All
    Input Text    fname    456879
	Input Text    lname    123456
	Input Text    email    songchan@gmail.com
	Input Text    password    Pawee3
	Input Text    mobile    063-*06-2@55
	Click Button    btn-submit
	Wait Until Page Contains     ชื่อไม่ถูกต้อง
	Wait Until Page Contains     นามสกุลไม่ถูกต้อง
	Wait Until Page Contains     อีเมล ไม่ถูกต้อง
	Wait Until Page Contains     รหัสผ่านต้องมีความยาว 8-16 ตัว ประกอบด้วยตัวอักษรภาษาอังกฤษ A-Z a-z และตัวเลข
	Wait Until Page Contains     กรุณาใส่ ยืนยันรหัสผ่าน
	Wait Until Page Contains     กรุณาใส่ที่อยู่
	Wait Until Page Contains     เบอร์โทรไม่ถูกต้อง

