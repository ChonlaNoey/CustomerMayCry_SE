*** Settings ***
Library    SeleniumLibrary


*** Variables ***
${BROWSER}        Chrome
${LOG_IN}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/index.php
${LIST_ACCOUNT}        http://10.199.66.227/SoftEn2020/Sec01/CustomerMayCry/soften/public/user_manager.php



*** Test Cases ***
Open List Account page
    Open Browser    ${LOG_IN}    ${BROWSER}
	Click Element    staff
	Input Text    email    admin@kku.ac.th
	Input Text    password    adminKKU123
	Click Button    btn-submit
	Click Element    userManage
	Location Should Be    ${LIST_ACCOUNT}
	
Invalid Close account
    Click Element    stdDeact2
	Sleep   2s
	Click Button    stdDeactivatedCancel2
	Page Should Contain Element    stdPermission2
	Sleep   1s
	
Valid Close account
    Click Element    stdDeact2
	Sleep   2s
	Click Button    std-deactivated2
	Page Should Contain Element    stdPermission2
	Sleep   1s
	
Invalid Open account 
    Click Element    stdDeact2
	Sleep   2s
	Click Button    stdActivatedCancel2
	Page Should Contain Element    stdPermission2
	Sleep   1s
	
Valid Open account
    Click Element    stdDeact2
	Sleep   2s
	Click Button    std-activated2
	Page Should Contain Element    stdPermission2
	Sleep   1s
	
	[Teardown]    Close Browser