// here we done delete function for all page
var global_url = $("#web_url").val();
function deleteMe(url){
	if(url != ''){
		var iAnswer = confirm("Are you sure you want to delete this row ?");
		if(iAnswer){
			window.location.href = url;
		}
	}
}

//Image load here
var loadFile = function(event) {
var output = document.getElementById('output');
output.src = URL.createObjectURL(event.target.files[0]);
};

//Date Picker here
$(function() {
	$(".datepicker").attr("data-date-format", "dd/mm/yyyy");
	$(".datepicker").datepicker();
});

$(document).ready(function() {
  setTimeout('hideMsg()',3000);
	$("#updateprofile").submit(function(e)
	{
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				if(data == '-99'){
					window.location = $("#web_url").val() + 'logout.php';
				}
				else{
					alert('Update Profile Information Successfully');
					window.location = $("#web_url").val() + 'logout.php';
				}
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
				alert(textStatus);    
			}
		});
		e.preventDefault();
	});
});

//success massage
function hideMsg(){
	$("#msg_boxx").slideUp();
}

//tooltip code here
$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});

//all list search code here
function getClassData2(cval,pagename){
	if(cval != ''){
		var tval = $("#ddlTeminal").val();
		if(tval != '-1'){
			window.location.href = pagename + '.php?tval=' + tval + '&cval=' + cval;
		}
		else{
			window.location.href = pagename + '.php?cval=' + cval;
		}
	}
}

//search code for class and roll here
function getRollClass(cval,pagename){
	if(cval != ''){
		var tval = $("#ddlRoll").val();
		if(tval != '-1'){
			window.location.href = pagename + '.php?tval=' + tval + '&cval=' + cval;
		}
		else{
			window.location.href = pagename + '.php?cval=' + cval;
		}
	}
}

//search code for class and roll here
function getRollClass1(cval,pagename){
	if(cval != ''){
		var cval = $("#ddlClass").val();
		if(cval != '-1'){
			window.location.href = pagename + '.php?cval=' + cval;
		}
		else{
			//window.location.href = pagename + '.php?cval=' + cval;
		}
	}
}


//get roll search code here
function getRollData(tval,pagename){
	if(tval != ''){
		var cval = $("#ddlClass").val();
		if(cval != '-1'){
			window.location.href = pagename + '.php?tval=' + tval + '&cval=' + cval;
		}
		else{
			window.location.href = pagename + '.php?tval=' + tval;
		}
	}
}


//get class using ajax
function getClassData(val,pagename){
	if(val != ''){
		window.location.href = pagename + '.php?cid=' + val;
	}
}

//get subject using ajax when select class
function getSubject(val){
	if(val != ''){
		$.get("../ajax/getsubject.php?classid=" + val , function(data, status){
			$("#dllESSubjectId").html(data);
		});
	}
	else{
		alert('Please select any class');
	}
}

//get student info by class name
function getStudent(val){
	if(val != ''){
		$.get("../ajax/getstudent.php?classid=" + val , function(data, status){
			$("#dllStNameId").html(data);
		});
	}
	else{
		alert('Please select any class');
		$("#dllStNameId").html("");
		$("#dllStNameId").html("<option>--Select Student--</option>");
	}
}

//get hostel name using student id
function getHostel(val){
	if(val != ''){
		//alert(val);
		$.get("../ajax/gethostel.php?hid=" + val , function(data, status){
			$("#dllHostelId").html(data);
		});
	}
	else{
		alert('Please select any student');
		$("#dllHostelId").html("");
		$("#dllHostelId").html("<option>--Select Hostel--</option>");
	}
}

//get author info by book name
function getAuthorName(val){
	if(val != ''){
		$.get("../ajax/getauthorname.php?bid=" + val , function(data, status){
			$("#ddlAuthorName").val(data);
		});
	}
	else{
		alert('Please select any book');
	}
}

//get Destination Amount...
function getTransportPay(val){
	if(val != ''){
		$.get("../ajax/getransportpay.php?pid=" + val , function(data, status){
			$("#txtTrMbFee").val(data);
		});
	}
	else{
		alert('Please select any destination');
	}
}

//get Destination Amount...
function getTransportPay1(val){
	if(val != ''){
		$.get("../ajax/getransportpay1.php?pid=" + val , function(data, status){
			$("#txtTransportAmount").val(data);
		});
	}
	else{
		alert('Please select any destination');
	}
}

//get student info by class name
function getStudentWithRoll(val){
	if(val != ''){
		$.get("../ajax/getstudentwithroll.php?classid=" + val , function(data, status){
			$("#dllStNameId").html(data);
		});
	}
	else{
		alert('Please select any class');
		$("#dllStNameId").html("");
		$("#dllStNameId").html("<option>--Select Student--</option>");
	}
}
//get student info by class name for parent
function getStudentWithRollParent(val){
	if(val != ''){
		$.get("../ajax/getstudentwithrollparent.php?classid=" + val , function(data, status){
			$("#dllStNameId").html(data);
		});
	}
	else{
		alert('Please select any class');
		$("#dllStNameId").html("");
		$("#dllStNameId").html("<option>--Select Student--</option>");
	}
}

//get student info by class namefor parents
function getStudentWithRollForParents(val){
	if(val != ''){
		$.get("../ajax/getstudentcheckbox.php?classid=" + val , function(data, status){
			$("#area_student_info").html(data);
		});
	}
	else{
		alert('Please select any class');
		$("#area_student_info").html("");
	}
}

//get Author using ajax when select class
function getAuthor(val){
	if(val != ''){
		$.get("../ajax/getauthor.php?aid=" + val , function(data, status){
			$("#dllLbAuthorId").html(data);
		});
	}
	else{
		alert('Please select any book');
	}
}

function getTerminalData(tval,pagename){
	if(tval != ''){
		var cval = $("#ddlClass").val();
		if(cval != '-1'){
			window.location.href = pagename + '.php?tval=' + tval + '&cval=' + cval;
		}
		else{
			window.location.href = pagename + '.php?tval=' + tval;
		}
	}
}
//get Category Type using Hostel Name
function getCategoryType(val){
	if(val != ''){
		$.get("../ajax/getcategorytype.php?hostelid=" + val , function(data, status){
			$("#txtCategoryType").val(data);
		});
	}
	else{
		alert('Please select any hostel');
	}
}

//get Roll Number
function getRoll(val){
	if(val != ''){
		$.get("../ajax/getroll.php?rid=" + val , function(data, status){
			$("#ddlRoll").html(data);
		});
	}
	else{
		alert('Please select any roll');
		$("#ddlRoll").html("");
		$("#ddlRoll").html("<option>--Select Roll--</option>");
	}
}

//get Student Type of Fee using...
function getTypeFee(val){
	if(val != ''){
		$.get("../ajax/gettypefee.php?fid=" + val , function(data, status){
			$("#txtStAmount").val(data);
		});
	}
	else{
		alert('Please select any type');
	}
}


// get Student Attendance by Month...
function getStudentAttByMonth(val){
	if(val != ''){
		if($("#a_cid").val() != '' && $("#a_sid").val() != ''){
			window.location = '../attendance/attendance_details.php?sid=' + $("#a_sid").val() + '&cid=' + $("#a_cid").val() + '&mval=' + val;
		}
	}
	else{
		alert('Please select any month');
	}
}
//get student attendance for parent...
function getStudentAttByMonthForParents(val){
	if(val != ''){
		if($("#a_cid").val() != '' && $("#a_sid").val() != ''){
			window.location = '../attendance/p_attendance_details.php?sid=' + $("#a_sid").val() + '&cid=' + $("#a_cid").val() + '&mval=' + val;
		}
	}
	else{
		alert('Please select any month');
	}
}
//get student attendance for teacher...
function getStudentAttByMonthTeacher(val){
	if(val != ''){
		if($("#a_cid").val() != '' && $("#a_sid").val() != ''){
			window.location = '../attendance/t_attendance_details.php?sid=' + $("#a_sid").val() + '&cid=' + $("#a_cid").val() + '&mval=' + val;
		}
	}
	else{
		alert('Please select any month');
	}
}
// add library member 
function addLibraryMember(sid,cid){
	if(sid != '' && cid != ''){
		$.post("../ajax/addlibrarymember.php?cid=" + cid + "&sid=" + sid , function(data, status){
			if(data == ''){
				alert('Error Occured');
			}
			else{
				alert("Added Member Successfully and Member Id " + data);
				window.location.reload();
			}
		});
	}
}

// add transport member 
function addTransportMember(sid,cid){
	if(sid != '' && cid != ''){
		$.post("../ajax/addtransportmember.php?cid=" + cid + "&sid=" + sid , function(data, status){
			if(data == ''){
				alert('Error Occured');
			}
			else{
				alert("Added Member Successfully and Member Id " + data);
				window.location.reload();
			}
		});
	}
}


//login form submit
function validateLoginForm(){
	var bcon = true;
	if($("#username").val() == ''){
		alert("Email Required");
		$("#username").focus();
		bcon = false;
	}
	else if(!checkEmail('username')){
		bcon = false;
	}
	else if($("#password").val() == ''){
		alert("Please enter your password");
		$("#password").focus();
		bcon = false;
	}
	else if($("#ddlLoginType").val() == '-1'){
		alert("Please select login type");
		bcon = false;
	}
	else if($("#ddlBranch").val() == '-1'){
		alert("Please select Your Branch");
		bcon = false;
	}
	return bcon;
}
function addme(obj){
	var x1 = $("#add_student").html();
	var x2 = $("#xstr_" + obj.value).html();
	if(x1 != ''){
		$("#add_student").html(x1 + ' <div class="tag_add">' + x2 + '</div>');
	}
	else{
		$("#add_student").html(' <div class="tag_add">' + x2 + '</div>');
	}
}

// get hostel member information
function loadMemberInfo(d){
	if(d != ''){
		$.post("../ajax/getHostelMemberInfo.php?mid=" + d , function(data, status){
			if(data != ''){
				var x1 = data.split("~");
				$("#dllHostelId").val(x1[0]);
				$("#txtHostelType").val(x1[1]);
				$("#txtStudentName").val(x1[2]);
				$("#txtClassName").val(x1[3]);
			}
			else{
				alert('No Member Found');
				$("#dllHostelId").val('');
				$("#txtHostelType").val('');
				$("#txtStudentName").val('');
				$("#txtClassName").val('');
			}
		});
	}
}

// get transport information
function loadTransportInfo(d){
	if(d != ''){
		$.post("../ajax/getTransportInfo.php?tid=" + d , function(data, status){
			if(data != ''){
				var x1 = data.split("~");
				$("#txtStudentName").val(x1[0]);
				$("#txtClassName").val(x1[1]);
				$("#txtDestination").val(x1[2]);
				$("#txtTransportAmount").val(x1[3]);
			}
			else{
				alert('No Member Found');
				$("#txtStudentName").val('');
				$("#txtClassName").val('');
				$("#txtDestination").val('');
				$("#txtTransportAmount").val('');
			}
		});
	}
}
function printContent(area,title){
	$("#"+area).printThis({
		 pageTitle: title
	});
}
