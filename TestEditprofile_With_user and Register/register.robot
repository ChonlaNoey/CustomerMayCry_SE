*** Settings ***

Library    SeleniumLibrary

*** Variables ***

${HOMEPAGE_URL}   http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/index.php
${STUDENT}    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/soften/public/Register_form_student.php
${STAFF}    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/soften/public/Register_form_staff.php
${BROWSER}    chrome
${emailVS}    pornpimol_p@kkumail
${passVS}    Pimol321
${emailVE}    paweena@kku.ac.th
${passVE}    Pawee321

*** Test Cases ***

TC001 Open Register page  
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Click Element    register
	Location Should Be    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/Register_status.php
	
TC002 Select Register Student
    Select Radio Button    status    student
	Sleep    2s
    Click Button    btn-submit
	Go To    ${STUDENT}
	Location Should Be    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/soften/public/Register_form_student.php
	
TC003 Select Register Staff
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Click Element    register
    select radio button    status    staff
	Sleep    2s
    Click Button    btn-submit
	Go To    ${STAFF} 	
	Location Should Be    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/soften/public/Register_form_staff.php
	
TC004 Not Select
	Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Click Element    register
    go back
	Location Should Be    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/index.php
	
TC005 Open Register Staff page
	Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Click Element    register
    Select Radio Button    status    staff
    Click Button    btn-submit
	Go To    ${STAFF}

TC006 Valid Register Staff 
    Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@kku.ac.th
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Select from list by value    work    2
	Click Button    regisstaff
	Sleep    2s
	Click Button    btn-submit
	
TC007 Invalid Login after Register Staff
	Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
    Select Radio Button    status    staff
	Input Text    email    paweena@kku.ac.th    
    Input Text    password    Pawee321    
	Click Button    btn-submit
	Wait Until Page Contains    กรุณารอการอนุมัติจากผู้ดูแลระบบ
	
TC008 Invalid Email Staff
	Click Element    register 
	Select Radio Button    status    staff
	Sleep    2s
    Click Button    btn-submit
	Go To    ${STAFF}
	Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    email    paweena@gmail.com
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Select from list by value    work    2
	Click Button    regisstaff
	Sleep    2s
	Click Button    btn-submit
	Wait Until Page Contains    อีเมลไม่ถูกต้อง
	
TC009 Invalid Email Staff(Empty)
	Click Element    register 
	Select Radio Button    status    staff
	Sleep    2s
    Click Button    btn-submit
	Go To    ${STAFF}
	Input Text    fname    ประวีณา
	Input Text    lname    อยู่ยิ่ง
	Input Text    password    Pawee321
	Input Text    confirm    Pawee321
	Input Text    address    218 ม.12 ต.ศิลา  อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-006-2355
	Select from list by value    work    2
	Click Button    regisstaff
	Sleep    2s
	Click Button    btn-submit
	Sleep    2s
	Wait Until Page Contains    กรุณากรอกอีเมล
	
TC010 Open Register Student page
	Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Click Element    register
    Select Radio Button    status    student
    Click Button    btn-submit
	Go To    ${STUDENT}
	
TC011 Valid Register Student
	Input Text    //*[@id="stdId"]    603020307-8
    Input Text    //*[@id="fname"]    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    //*[@id="email"]    pornpimol_p@kkumail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
    Select from list by value    course    1
	Input Text    level    3
	Click Button    regisstudent
	Sleep    2s
	Click Button    btn-submit	

TC012 Invalid Login after Register Student
	Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Select Radio Button    status    student
	Input Text    email    pornpimol_p@kkumail.com
    Input Text    password    Pimol123
	Click Button    btn-submit
	Wait Until Page Contains    กรุณารอการอนุมัติจากผู้ดูแลระบบ

TC013 Invalid Email Student
	Click Element    register 
	Select Radio Button    status    student
	Sleep    2s
    Click Button    btn-submit
	Go To    ${STUDENT}
	Input Text    //*[@id="stdId"]    603020307-8
    Input Text    //*[@id="fname"]    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    //*[@id="email"]    songchan@gmail.com
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
    Select from list by value    course    1
	Input Text    level    3
	Click Button    regisstudent
	Sleep    2s
	Click Button    btn-submit
	Wait Until Page Contains    อีเมลไม่ถูกต้อง

TC014 Invalid Email Student(Empty)
	Click Element    register 
	Select Radio Button    status    student
	Sleep    2s
    Click Button    btn-submit
	Go To    ${STUDENT}
	Input Text    //*[@id="stdId"]    603020307-8
    Input Text    //*[@id="fname"]    พรพิมล
	Input Text    lname    เพียรสองชั้น
	Input Text    password    Pimol123
	Input Text    confirm    Pimol123
	Input Text    address    580 ม.12 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    063-046-1878
    Select from list by value    course    1
	Input Text    level    3
	Click Button    regisstudent
	Sleep    2s
	Click Button    btn-submit
	Sleep    2s
	Wait Until Page Contains    กรุณากรอกอีเมล