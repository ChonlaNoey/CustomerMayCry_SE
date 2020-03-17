*** Settings ***
Library    SeleniumLibrary


*** Variables ***
${BROWSER}        Chrome
${LOG_IN}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/index.php
${LIST_ACCOUNT}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/user_manager.php
${EDIT_STAFF}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/staff_edit_profile_by_admin.php?email=paweena@kku.ac.th
${DASH_USER}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/dashboard_user.php#
${SAVE}        แจ้งเตือน!บันทึกข้อมูลสำเร็จ
${PASS_SAVE}        แจ้งเตือน!รีเซ็ตรหัสผ่านสำเร็จ
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
	Sleep    2s
	Click Element    staff-tab
	Sleep    1s
	Click Element    staffEdit1
	Location Should Be    ${EDIT_STAFF}
	
Empty Edit Profile Staff	
	Input Text    fname    ${EMPTY}
	Input Text    lname    ${EMPTY}
	Input Text    email    ${EMPTY}
	Input Text    addr    ${EMPTY}
	Input Text    mobile    ${EMPTY}
	Click Button    save
	Sleep    2s
	Click Button    btn-submit-prof
	Wait Until Page Contains    ${SAVE}
	
Cancel Edit Profile Staff
	Input Text    fname    ปราณี
	Input Text    lname    อยู่นาน
	Input Text    email    pawee@kku.ac.th
	Input Text    addr    21 ม.2 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    0963216545
	Select From List by Value    xpath=//select[@id="positionId"]    1
	Click Button    save
	Sleep    2s
	Click Button    cancel-prof
	Wait Until Page Contains    ${SAVE}
	Title Should Be    แก้ไขโปรไฟล์ของบุคลากร
	
	
Valid Edit Profile Staff 
	Input Text    fname    ปราณี
	Input Text    lname    อยู่นาน
	Input Text    email    pawee@kku.ac.th
	Input Text    addr    21 ม.2 ต.ศิลา อ.เมือง จ.ขอนแก่น 40000
	Input Text    mobile    0963216545
	Select From List by Value    xpath=//select[@id="positionId"]    1
	Click Button    save
	Sleep    2s
	Click Button    btn-submit-prof
	Wait Until Page Contains    ${SAVE}
	
Valid Reset Password Staff
    Click Button    changePassword
	Sleep    2s
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${PASS_SAVE}
	Sleep    2s
	
No Big Character In Reset Password Staff
    Click Button    changePassword
	Sleep    2s
	Input Text    psw    pawee321
	Input Text    repsw    pawee321
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
No Small Character In Reset Password Staff
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    PAWEE321
	Input Text    repsw    PAWEE321
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
No Number In Reset Password Staff
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    PAWEEnaja
	Input Text    repsw    PAWEEnaja
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
Least Character In Reset Password Staff
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    Pawee1
	Input Text    repsw    Pawee1
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
Not match In Reset Password Staff
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    Pawee025
	Input Text    repsw    Pawee258
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
Empty In Reset Password Staff
    Click Button    changePassword
	Sleep    2s
    Input Text    psw    ${EMPTY}
	Input Text    repsw    ${EMPTY}
	Click Button    btn-submit-pw
	Wait Until Page Contains    ${WARN_PASS}
	Sleep    2s
	
Cancel Reset Password Staff
    Click Button    changePassword
	Sleep    2s
    Click Button    cancel-pw
	Sleep    2s
	Title Should Be    แก้ไขโปรไฟล์ของบุคลากร
	
Notify User
    Open Browser    ${LOG_IN}    ${BROWSER}
	Click Element    staff
	Input Text    email    pawee@kku.ac.th
	Input Text    password    borrowCS123
	Click Button    btn-submit
	Location Should Be    ${DASH_USER}
	Wait Until Page Contains    ${WARN_USER} 
	Close Browser