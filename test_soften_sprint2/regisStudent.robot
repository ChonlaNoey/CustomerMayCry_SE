*** Settings ***

Library    SeleniumLibrary

*** Variables ***

${HOMEPAGE_URL}   http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/testing/
${BROWSER}    chrome
${emailVS}    pornpimol_p@kkumail.com
${passVS}    Pimol123
${emailVE}    paweena@kku.ac.th
${passVE}    Pawee321

*** Test Cases ***

TC036 Open Register page  
    Open Browser    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/soften/public/Register_form_student.php    ${BROWSER}
	
TC037 Valid Register Student
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    ลงทะเบียนสำเร็จ
	Close Browser
	
TC038 Open Register page  
    Open Browser    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/soften/public/Register_form_student.php    ${BROWSER}

TC039 Invalid Name
    Input Text    fname    789456
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    ชื่อไม่ถูกต้อง

TC040 Invalid Name(Eng)
    Input Text    fname    pornpimol
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    ชื่อไม่ถูกต้อง
	
TC041 Invalid Name(SpecailChar)
    Input Text    fname    @พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    ชื่อไม่ถูกต้อง
	
TC042 Invalid Name(Emtpy)
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกชื่อ

TC043 Invalid LastName
    Input Text    fname    พรพิมล
	Input Text    lname    321654
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    นามสกุลไม่ถูกต้อง

TC044 Invalid LastName(Eng)
    Input Text    fname    พรพิมล
	Input Text    lname    Piensongchan
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    นามสกุลไม่ถูกต้อง

TC045 Invalid LastName(SpecailChar)
    Input Text    fname    พรพิมล
	Input Text    lname    @พียร*สอง#ชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    นามสกุลไม่ถูกต้อง

TC046 Invalid LastName(Emtpy)
    Input Text    fname    พรพิมล
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกนามสกุล

TC047 Invalid Email
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    songchan@gmail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    ลงทะเบียนสำเร็จ

TC048 Invalid Email
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    songchan@gmail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    email ไม่ถูกต้อง
	
TC049 Invalid Email(No@)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_pkkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    email ไม่ถูกต้อง
	
TC050 Invalid Email(@kku.ac.th)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    email ไม่ถูกต้อง
	
TC051 Invalid Email(Emtpy)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกอีเมล
	
TC052 Invalid password
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol1
	Input Text    confirm    Pimol1
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสผ่านต้องมีความยาว 8-16 ตัว ประกอบด้วยตัวอักษรภาษาอังกฤษ A-Z a-z และตัวเลข
	
TC053 Invalid password(LessThan8)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol12
	Input Text    confirm    Pimol12
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสผ่านต้องมีความยาว 8-16 ตัว ประกอบด้วยตัวอักษรภาษาอังกฤษ A-Z a-z และตัวเลข

TC054 Invalid password(MoreThan8)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    pornpimol321654987P
	Input Text    confirm    pornpimol321654987P
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสผ่านต้องมีความยาว 8-16 ตัว ประกอบด้วยตัวอักษรภาษาอังกฤษ A-Z a-z และตัวเลข

TC055 Invalid password(SmallChar)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    pimol123
	Input Text    confirm    pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสผ่านต้องมีความยาว 8-16 ตัว ประกอบด้วยตัวอักษรภาษาอังกฤษ A-Z a-z และตัวเลข
	
TC056 Invalid password(LargeChar)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    PAWEE321
	Input Text    confirm    PAWEE321
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสผ่านต้องมีความยาว 8-16 ตัว ประกอบด้วยตัวอักษรภาษาอังกฤษ A-Z a-z และตัวเลข
	
TC057 Invalid password(NoNum)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    PaweenaU
	Input Text    confirm    PaweenaU
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสผ่านต้องมีความยาว 8-16 ตัว ประกอบด้วยตัวอักษรภาษาอังกฤษ A-Z a-z และตัวเลข
	
TC058 Invalid password(NoChar)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    32165423
	Input Text    confirm    32165423
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสผ่านต้องมีความยาว 8-16 ตัว ประกอบด้วยตัวอักษรภาษาอังกฤษ A-Z a-z และตัวเลข
	
TC059 Invalid password(Empty)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกรหัสผ่านให้ถูกต้อง
	
TC060 Invalid confirm password
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol312
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    ยืนยันรหัสผ่าน ไม่ถูกต้อง

TC061 Invalid confirm password(Empty)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกยืนยันรหัสผ่านให้ถูกต้อง

TC062 Invalid Position(Emtpy)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกที่อยู่
	
TC063 Invalid Phone
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-*04-6@78
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    เบอร์โทรไม่ถูกต้อง
	
TC064 Invalid Phone(LessThan10)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-187
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    เบอร์โทรไม่ถูกต้อง
	
TC065 Invalid Phone(MoreThan10)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-18788
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    เบอร์โทรไม่ถูกต้อง
	
TC066 Invalid Phone(Emtpy)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Select Radio Button    bachelor
	Input Text    stdId    603020307-8
	Input Text    level    3
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกเบอร์โทรศัพท์
	
TC067 Invalid StudentID
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    @0302*307-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสนักศึกษาไม่ถูกต้อง

TC068 Invalid StudentID(LessThan10)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    60302030-7
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสนักศึกษาไม่ถูกต้อง

TC069 Invalid StudentID(MoreThan10)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    6030203078-8
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    รหัสนักศึกษาไม่ถูกต้อง
	
TC070 Invalid StudentID(Emtpy)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    level    3
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณากรอกรหัสนักศึกษา
	
TC071 Invalid Degree(Emtpy)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณาเลือกระดับการศึกษา
	
TC072 Invalid Year(Emtpy)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Select Radio Button    bachelor
    Select from list by value    CS    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณาระบุชั้นปี
	
TC073 Invalid Course(Emtpy)
    Input Text    fname    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    email    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
	Input Text    stdId    603020307-8
	Input Text    level    3
	Select Radio Button    bachelor
	Click Button    btn-submit
	Wait Until Page Contains    กรุณาเลือกสาขา
	
TC074 Valid Register Student
	Wait Until Page Contains    ชื่อไม่ถูกต้อง
	Wait Until Page Contains    นามสกุลไม่ถูกต้อง
	Wait Until Page Contains    อีเมล ไม่ถูกต้อง
	Wait Until Page Contains    รหัสผ่านต้องมีความยาว 8-16 ตัว ประกอบด้วยตัวอักษรภาษาอังกฤษ A-Z a-z และตัวเลข
	Wait Until Page Contains    กรุณากรอกยืนยันรหัสผ่าน
	Wait Until Page Contains    กรุณากรอกที่อยู่
	Wait Until Page Contains    กรุณากรอกเบอร์โทรศัพท์
	Wait Until Page Contains    กรุณากรอกรหัสนักศึกษา
	Wait Until Page Contains    กรุณาเลือกระดับการศึกษา
	Wait Until Page Contains    กรุณาระบุชั้นปี
	Wait Until Page Contains    กรุณาเลือกสาขา


