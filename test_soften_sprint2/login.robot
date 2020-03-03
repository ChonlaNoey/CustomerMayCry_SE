*** Settings ***

Library    SeleniumLibrary

*** Variables ***

${HOMEPAGE_URL}   http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/soften/
${BROWSER}    chrome
${emailVS}    pornpimol_p@kkumail.com
${passVS}    Pimol123
${emailVE}    paweena@kku.ac.th
${passVE}    Pawee321

*** Test Cases ***

TC001 Open Login page  
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}

TC002 Valid Login Student
    Select Radio Button    status    student
	Input Text    email    ${emailVS}
    Input Text    password    ${passVS}
	Click Button    btn-submit
	Close Browser

TC003 Valid Login Employee
	Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
    Select Radio Button    status    staff
	Input Text    email    ${emailVE}
    Input Text    password    ${passVE}
	Click Button    btn-submit
	Close Browser

TC004 Open Login page  
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}

TC005 Invalid Password
    Select Radio Button    status    student
    Input Text    email    ${emailVS}
    Input Text    password    Pimol
	Click Button    btn-submit
    Wait Until Page Contains    อีเมลหรือรหัสผ่านไม่ถูกต้อง
	
TC006 Invalid Email Not KKU
    Input Text    email    songchan@gmail.com
    Input Text    password    SongChan22
	Click Button    btn-submit
    Wait Until Page Contains    อีเมลหรือรหัสผ่านไม่ถูกต้อง
	
TC007 Invalid Email Employee
    Select Radio Button    status    staff
    Input Text    email    paweenakku.ac.th
    Input Text    password    ${passVE}
	Click Button    btn-submit
    Wait Until Page Contains    อีเมลหรือรหัสผ่านไม่ถูกต้อง
	
TC008 Invalid Email Student
    Select Radio Button    status    student
    Input Text    email    pornpimol_pkkumail.com
    Input Text    password    ${passVS}
	Click Button    btn-submit
    Wait Until Page Contains    อีเมลหรือรหัสผ่านไม่ถูกต้อง
	
TC009 Invalid Login
    Input Text    email    songchan@gmail.com
    Input Text    password    Song22
	Click Button    btn-submit
    Wait Until Page Contains    อีเมลหรือรหัสผ่านไม่ถูกต้อง
	
TC010 Empty Email
    Input Text    password    ${passVS}
	Click Button    btn-submit
    Wait Until Page Contains    กรุณากรอกข้อมูลในช่องนี้
	
TC011 Empty Password
    Input Text    email    ${emailVS}
	Click Button    btn-submit
    Wait Until Page Contains    กรุณากรอกข้อมูลในช่องนี้
	
TC012 Empty Login
	Click Button    btn-submit
    Wait Until Page Contains    กรุณากรอกข้อมูลในช่องนี้