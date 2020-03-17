*** Settings ***

Library    SeleniumLibrary

*** Variables ***

${HOMEPAGE_URL}   http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/index.php
${BROWSER}    chrome
${emailVS}    supakrit_t@kkumail.com
${passVS}    Sf121231
${emailVE}    pawee@kku.ac.th
${passVE}    Pawee321

*** Test Cases ***

TC001
	Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
    Select Radio Button    status    student
	Input Text    email    ${emailVS}
    Input Text    password    ${passVS}
	Click Button    btn-submit
	Click Element    setting
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/student_edit_profile.php
	Sleep    1s
	
TC002
	Click Button    save
	Sleep    2s
	Click Button    btn-submit-prof
	Wait Until Page Contains    แจ้งเตือน! บันทึกข้อมูลสำเร็จ
	Sleep    1s

TC003
	Input Text    fname    ศุภกฤต
	Input Text    lname    เทพพระ
	Input Text    address    109/22 ถ.โพธิสาร ต.ในเมือง อ.เมือง จ.ขอนแก่น
	Input Text    mobile    0986254122
	Click Button    save
	Sleep    2s
	Click Button    cancel-prof
	Sleep    1s
	
TC004
	Input Text    fname    ศุภกฤต
	Input Text    lname    เพียรสนาม
	Input Text    address    109/22 ถ.โพธิสาร ต.ในเมือง อ.เมือง จ.ขอนแก่น
	Input Text    mobile    0986254122
	Click Button    save
	Sleep    2s
	Click Button    btn-submit-prof
	Wait Until Page Contains    แจ้งเตือน! บันทึกข้อมูลสำเร็จ
	Sleep    1s
	
TC005
	Click Button    changePassword
	Sleep    2s
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! เปลี่ยนรหัสผ่านสำเร็จ
	Sleep    1s
	
TC006
	Click Button    changePassword
	Clear Element Text    //*[@id="psw"]
	Clear Element Text	  //*[@id="repsw"]
	Input Text    psw    pimol123
	Input Text    repsw    pimol123
	Sleep    1s
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s

TC007
	Click Button    changePassword
	Input Text    psw    PIMOL123
	Input Text    repsw    PIMOL123
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s

TC008
	Click Button    changePassword
	Input Text    psw    PIMOLsong
	Input Text    repsw    PIMOLsong
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s

TC009
	Click Button    changePassword
	Input Text    psw    Pimol1
	Input Text    repsw    Pimol1
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s
	
TC010
	Click Button    changePassword
	Input Text    psw    Pimol109
	Input Text    repsw    Pimol108
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s

TC011
	Click Button    changePassword
	Input Text    psw    ${EMTPY}     
	Input Text    repsw    ${EMTPY}     
	Click Button    btn-submit-pw
	Wait Until Page Contains    กรุณากรอกข้อมูลในช่องนี้
	Sleep    1s
	Reload page

TC012
    Click Button    changePassword
	Click Button    cancel-pw
	Location Should Be    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/soften/public/student_edit_profile.php
	Sleep    1s

TC013
	Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
    Select Radio Button    status    staff
	Input Text    email    ajarn@kku.ac.th 
    Input Text    password    borrowCS123
	Click Button    btn-submit
	Click Element    //*[@id="setting"]
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/staff_edit_profile.php
	Location Should Be    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/staff_edit_profile.php
	Sleep    1s
	
TC014
	Click Button    //*[@id="save"]
	Sleep    2s
	Click Button    btn-submit-prof
	Wait Until Page Contains    แจ้งเตือน! บันทึกข้อมูลสำเร็จ
	Sleep    1s
	Reload Page

TC015
	Go To    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/staff_edit_profile.php
	Input Text    fname    ปราณี
	Input Text    lname    อยู่นาน
	Input Text    addr    21 ม.2 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    0963216545
	Click Button    save
	Sleep    2s
	Click Button    cancel-prof
	Location Should Be    http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/staff_edit_profile.php
	Sleep    1s
	Reload Page

TC016
	Input Text    fname    ปราณี
	Input Text    lname    อยู่นาน
	Input Text    addr    21 ม.2 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    0963216545
	Click Button    save
	Sleep    2s
	Click Button    btn-submit-prof
	Wait Until Page Contains    แจ้งเตือน! บันทึกข้อมูลสำเร็จ
	Sleep    1s
	
TC017
	Click Button    changePassword
	Sleep    2s
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! เปลี่ยนรหัสผ่านสำเร็จ
	Sleep    1s
	
TC018
	Reload Page
	Click Button    changePassword
	Input Text    psw    pimol123
	Input Text    repsw    pimol123
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s

TC019
	Click Button    changePassword
	Input Text    psw    PIMOL123
	Input Text    repsw    PIMOL123
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s

TC020
	Click Button    changePassword
	Input Text    psw    PIMOLsong
	Input Text    repsw    PIMOLsong
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s

TC021
	Click Button    changePassword
	Input Text    psw    Pimol1
	Input Text    repsw    Pimol1
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s

TC022
	Click Button    changePassword
	Input Text    psw    Pimol109
	Input Text    repsw    Pimol108
	Click Button    btn-submit-pw
	Wait Until Page Contains    แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
	Sleep    1s

TC023
	Click Button    changePassword
	Input Text    psw    ${EMTPY}     
	Input Text    repsw    ${EMTPY}     
	Click Button    btn-submit-pw
	Wait Until Page Contains    กรุณากรอกข้อมูลในช่องนี้
	Sleep    1s
	Reload Page

TC024
    Click Button    changePassword
	Sleep    1s
	Click Button    cancel-pw
	Location Should Be    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/soften/public/student_edit_profile.php
	
	