*** Settings ***
Library    SeleniumLibrary


*** Variables ***
${BROWSER}        Chrome
${LOG_IN}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/index.php
${LIST_ACCOUNT}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/user_manager.php
${EDIT_STUDENT}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/student_edit_profile_by_admin.php?stdId=603020307-8
${DASH_USER}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/dashboard_user.php#
${SAVE}        แจ้งเตือน! บันทึกข้อมูลสำเร็จ
${PASS_SAVE}        แจ้งเตือน! รีเซ็ตรหัสผ่านสำเร็จ
${WARN_PASS}        แจ้งเตือน! รีเซ็ตรหัสผ่านไม่สำเร็จ
${WARN_USER}        แจ้งเตือน! ข้อมูลของคุณได้ถูกแก้ไขโดยแอดมิน กรุณาเข้าสู่ระบบใหม่อีกครั้ง




*** Test Cases ***
Open Edit Profile page
    Open Browser    ${LOG_IN}    ${BROWSER}
	Click Element    staff
	Input Text    email    admin@kku.ac.th
	Input Text    password    adminKKU123
	Click Button    btn-submit
	Click Element    userManage
	Location Should Be    ${LIST_ACCOUNT}
	Click Element    stdEdit2
	Location Should Be    ${EDIT_STUDENT}
	
Empty Edit Profile
    Input Text    stdId    ${EMPTY}
	Input Text    fname    ${EMPTY}
	Input Text    lname    ${EMPTY}
	Input Text    email    ${EMPTY}
	Input Text    address    ${EMPTY}
	Input Text    mobile    ${EMPTY}
	Input Text    year    ${EMPTY}
	Click Button    save
	Sleep    2s
	Click Button    btn-submit-prof
	Wait Until Page Contains    ${SAVE}
	
Cancel Edit Profile
    Input Text    stdId    603020307-9
	Input Text    fname    พรพิล
	Input Text    lname    เพียรสนาม
	Input Text    email    pornpimol@kkumail.com
	Input Text    address    50 ม.2 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    0890901111
	Select From List by Value    xpath=//select[@id="courseId"]    2
	Input Text    year    4
	Click Button    save
	Sleep    2s
	Click Button    cancel-prof
	Title Should Be    แก้ไขโปรไฟล์นักศึกษา
	
Valid Edit Profile
    Input Text    stdId    603020307-9
	Input Text    fname    พรพิล
	Input Text    lname    เพียรสนาม
	Input Text    email    pornpimol@kkumail.com
	Input Text    address    50 ม.2 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    0890901111
	Select From List by Value    xpath=//select[@id="courseId"]    2
	Input Text    year    4
	Click Button    save
	Sleep    2s
	Click Button    btn-submit-prof
	Wait Until Page Contains    ${SAVE}
	
Valid Reset Password
    Click Button    changePassword
	Sleep    2s
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${PASS_SAVE}
	Sleep    2s

No Big Character In Reset Password
    Click Button    changePassword
	Sleep    2s
	Input Text    psw    pimol123
	Input Text    repsw    pimol123
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
No Small Character In Reset Password
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    PIMOL123
	Input Text    repsw    PIMOL123
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
No Number In Reset Password
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    PIMOLsong
	Input Text    repsw    PIMOLsong
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
Least Character In Reset Password
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    Pimol1
	Input Text    repsw    Pimol1
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
Not match In Reset Password
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    Pimol109
	Input Text    repsw    Pimol108
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
Empty In Reset Password
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    ${EMPTY}
	Input Text    repsw    ${EMPTY}
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
Cancel Reset Password
    Click Button    changePassword
	Sleep    2s
    Click Button    cancel-pw
	Sleep    2s
	Title Should Be    แก้ไขโปรไฟล์นักศึกษา
	
Notify User
    Open Browser    ${LOG_IN}    ${BROWSER}
	Click Element    student
	Input Text    email    pornpimol@kkumail.com
	Input Text    password    borrowCS123
	Click Button    btn-submit
	Location Should Be    ${DASH_USER}
	Wait Until Page Contains    ${WARN_USER} 
	Close Browser
	
	