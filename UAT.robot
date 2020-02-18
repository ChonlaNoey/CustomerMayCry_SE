*** Settings ***

Library    SeleniumLibrary

*** Variables ***

${HOMEPAGE_URL}   http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/testing/
${LIST_URL}   http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/testing/list.php
${BROWSER}    chrome

*** Test Cases ***

menupage  
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}

Add equipment 
    Go To    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/testing/insert.php    
	Input Text    tname    เอชพี โปร เดสท์
	Input Text    ename    HP Pro Desk
	Select From List By Value    equip_type    ไม่สามารถพกพาได้
	Select From List By Value    cid    6
	Click Button    btn-submit
	Reload Page

Add equipment No name    
	Input Text    tname    
	Input Text    ename    
	Select From List By Value    equip_type    ไม่สามารถพกพาได้
	Select From List By Value    cid    6
	Click Button    btn-submit
	Reload Page

Add equipment invalid Thai name 	
    Input Text    tname    HP Pro Desk
	Input Text    ename    HP Pro Desk
	Select From List By Value    equip_type    ไม่สามารถพกพาได้
	Select From List By Value    cid    6
	Click Button    btn-submit
	Reload Page

Add equipment invalid English name 
    Input Text    tname    เอชพี โปร เดสท์
	Input Text    ename    เอชพี โปร เดสท์
	Select From List By Value    equip_type    ไม่สามารถพกพาได้
	Select From List By Value    cid    6
	Click Button    btn-submit
	Reload Page

Add equipment No Type 
    Input Text    tname    เอชพี โปร เดสท์
	Input Text    ename    HP Pro Desk
	Select From List By Value    cid    6
	Click Button    btn-submit
	Reload Page

Add equipment No Category Type
    Input Text    tname    เอชพี โปร เดสท์
	Input Text    ename    HP Pro Desk
	Select From List By Value    equip_type    ไม่สามารถพกพาได้
	Click Button    btn-submit
	Close Browser	

Back Button
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Go To    http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/testing/insert.php
    Go Back
    Close Browser	
	
List page
    Open Browser    ${HOMEPAGE_URL}    ${BROWSER}
	Go To    ${LIST_URL}
    
Select Filter Invalid
    Select Checkbox    คอมพิวเตอร์ 
	Select Checkbox    สามารถพกพาได้
	Select Checkbox    ห้องเก็บของ
	Select Checkbox    ว่าง
	Reload Page
	
Select Filter
    Select Checkbox    คอมพิวเตอร์ 
    Select Checkbox    ไม่สามารถพกพาได้
	Select Checkbox    ห้องเก็บของ
	Select Checkbox    ว่าง
	Reload Page

Show Detail page
    GO TO     http://10.199.66.227/softEn2020/Sec01/CustomerMayCry/testing/showdetail.php?eid=PC1

Change Status	
    Select From List By Value    sid    2
	Click Button    btn-submit

Change location
    Select From List By Value    lid    4
	Click Button    btn-submit-log

Change Type
    Select From List By Value    cid    0
	Click Button    btn-submit-cat

Change Name
    Input Text    tname    เอชพี โปร เดสท์1
 	Input Text    ename    HP Pro Desk1
    Click Button    btn-submit-detail