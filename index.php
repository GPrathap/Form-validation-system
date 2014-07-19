<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Database Systems</title>
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="js/jquery-ui.js"></script>
 <script type="text/javascript" src="js/json2.js"></script>
  <script type="text/javascript">
  
    $(document).ready(function(){
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical > ui-helper-clearfix" );
    $( "#tabs >ul >li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    $("#tabsHeaders").tabs();
    $("#tabsHeadersofBooking").tabs();
    $( "#datepicker,#datepickerhalls,#datepickervehicles" ).datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: true,
      dateFormat:"yy-mm-dd"
    });
    var isVehi=0;
    var isHall=0;
    var isSemi=0;
    $("#radio33,#radio22,#radio11").buttonset();
    $("#radio3").change(function(){
    	if($('#radio3').is(":checked")){
    		$('#ra3').text("Ok");
    		
    		isVehi=1;
    	}else{
    		$('#ra3').text("Click to reserve");
    		isVehi=0;
    	}
    });
    $("#radio2").change(function(){
    	if($('#radio2').is(":checked")){
    		$('#ra2').text("Ok");
    		isHall=1;
    	}else{
    		$('#ra2').text("Click to reserve");
    		isHall=0;
    	}
    });
    $("#radio1").change(function(){
    	if($('#radio1').is(":checked")){
    		$('#ra1').text("Ok");
    		isSemi=1;
    		
    	}else{
    		$('#ra1').text("Click to reserve");
    		isSemi=0;
    	}
    });
  	$("#tabsHeaders li").tabs({
    	event:"mouseover"
    });
    var lect=0;
    var stud=0;
    var selectTag=0;
    $("#clicktobook").button().click(function(){
    	lect=1;
    	selectTag=lect;
    	stud=0;
    	isVehi=0;
    	isSemi=0;
    	isHall=0;
    	$('#ra1').text("Click to reserve");
    	$('#ra2').text("Click to reserve");
    	$('#ra3').text("Click to reserve");
    	$("#RegNumber,#NameofAssociation,#reglable,#assolable").hide();
    	$("#department,#depatlable").show();
    	$("#formtofill").dialog("open");
    });
    $("#clicktobookstudent").button().click(function(){
    	stud=1;
    	lect=0;
    	isVehi=0;
    	isSemi=0;
    	isHall=0;
    	selectTag=lect;
    	$('#ra1').text("Click to reserve");
    	$('#ra2').text("Click to reserve");
    	$('#ra3').text("Click to reserve");
    	$("#department,#depatlable").hide();
    	$("#RegNumber,#NameofAssociation,#reglable,#assolable").show();
    	$("#formtofill").dialog("open");
    });
     var  nameF = $( "#nameF" ),
      nameL = $("#nameL"),
      email = $( "#email" ),
      department = $( "#department" ),
      seminumber = $("#selectedIdSemi"),
      semidate = $("#semidate"),
      semitime = $("#semitime"),
      selectedIdSemi = $("#selectedIdSemi"),
      RegNumber = $("#RegNumber"),
      NameofAssociation = $("#NameofAssociation"),
      TelephoneNumber =$("#TelephoneNumber"),
      vehiCapacity=$("#pickervehicles"),
      durationpickerhalls=$("#durationpickerhalls"),
      dirationpicke = $("#dirationpicke"),
      allFields = $( [] ).add( nameF ).add( nameL ).add( email ).add( department ).
      			  add( RegNumber ).add( NameofAssociation ).add( TelephoneNumber ).add( vehiCapacity ),
      
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips.text( t ).addClass( "ui-state-highlight" );
      setTimeout(function() {tips.removeClass( "ui-state-highlight", 1500 );}, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
         updateTips( n );
        return false;
      } else {
        return true;
      }
    }
    function checkVehiCapacity( o ) {
     var type=$("#selectedIdvehicles").find(":selected").text();
     var max=10;
     if(type=="car1"){
     	if(o.val()>max){
     		o.addClass( "ui-state-error" );
        	updateTips( "Capacity of " + type + " must be between " +
          	0 + " and " + max + "." );
        return false;
     	}else {
        return true;
        }
     }
     if(type=="car2"){
     	var max=15;
     	if(o.val()>max){
     		o.addClass( "ui-state-error" );
        	updateTips( "Capacity of " + type + " must be between " +
          	0 + " and " + max + "." );
        return false;
     	}else {
        return true;
        }
     }
     if(type=="car3"){
     	var max=30;
     	if(o.val()>max){
     		o.addClass( "ui-state-error" );
        	updateTips( "Capacity of " + type + " must be between " +
          	0 + " and " + max + "." );
        return false;
     	}else {
        return true;
        }
     }
      
    }
   
    $( "#formtofill" ).dialog({
      autoOpen: false,
      resizable:true,
      width: 600,
      modal: true,
      
      buttons: {
        "Book now": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          bValid = bValid && checkLength( nameF, "First Name", 3, 30 );
          bValid = bValid && checkLength( nameL, "Last Name", 3, 30 );
          bValid = bValid && checkLength( email, "email", 6, 50 );
          bValid = bValid && checkLength( RegNumber, "RegNumber", 0, 6 );
          if(lect==1){
          bValid = bValid && checkLength( department, "department", 2, 20);
          bValid = bValid && checkRegexp( department, /^[a-z]([0-9a-z_])+$/i, "Department field only allow : a-z" );
 		  }
 		  bValid = bValid && checkRegexp( TelephoneNumber, /^[0-9]([0-9])+$/i, "TelephoneNumber field only allow : 0-9" );
 		  if(stud==1){
 		  bValid = bValid && checkRegexp( RegNumber, /^[a-z]([0-9])+$/i, "RegNumber field only allow : 0-9 and it should start with E/e" );
 		  bValid = bValid && checkRegexp( nameF, /^[a-z]([0-9a-z_])+$/i, "First name may consist of a-z, 0-9, underscores, begin with a letter." );
          bValid = bValid && checkRegexp( NameofAssociation, /^[a-z]([a-z_])+$/i, "NameofAssociation may consist of a-z, 0-9, underscores, begin with a letter." );
          bValid = bValid && checkRegexp( nameL, /^[a-z]([0-9a-z_])+$/i, "Last name may consist of a-z, 0-9, underscores, begin with a letter." );
          }// From http://projects.scottsplayground.com/email_address_validation/
          bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
          if(isVehi==1){
          bValid = bValid && checkVehiCapacity(vehiCapacity);
      	  }
         if(bValid==true){
         	info=[];
         	info.push(selectTag);
         	info.push(isSemi);
         	info.push(isHall);
         	info.push(isVehi);
           	info.push($("#nameF").val());
         	info.push($("#nameL").val());
         	info.push($("#email").val());
         	info.push($("#department").val());
         	info.push($("#TelephoneNumber").val());
         	info.push($("#RegNumber").val());
         	info.push($("#NameofAssociation").val());
         	info.push($("#selectedIdSemi").find(":selected").text());
         	
         	info.push(100);
           	info.push("TRUE");
         	info.push($("#selectedIdhalls").find(":selected").text());
         	info.push(100);
         	info.push("TRUE");
         	info.push("TRUE");
         	
         	info.push(12345);
         	info.push($("#pickervehicles").val());
         	info.push($("#selectedIdvehicles").find(":selected").text());
         	info.push("TRUE");
         	
         	
         	info.push($("#datepicker").val());
         	info.push($("#timepicker").val());
         	info.push($("#durationpicker").val());
         	
         	info.push($("#datepickerhalls").val());
         	info.push($("#timepickerhalls").val());
         	info.push($("#durationpickerhalls").val());
         	
         	info.push($("#datepickervehicles").val());
         	info.push($("#timepickervehicles").val());
         	
         	$.ajax({
         		type:"post",
         		url:"insert.php",
         		data:"dataset="+JSON.stringify(info),
         		success:function(){
         			 //alert(this.data);
         		}
         	});
			
         	$(this).dialog("close");
         }
        },
        Cancel: function() {
          $(this).dialog("close");
        }
      },
      close: function() {
        allFields.val("").removeClass("ui-state-error");
      }
    });
     function createTablerows(a1,a2,a3,a4,a5,a6){
    	var tr = "<tr><td>"+a1+"</td><td>"+a2+"</td><td>"+a3+"</td><td>"+a4+"</td><td>"+a5+"</td><td>"+a6+"</td></tr>";
		return tr;
    }
    
    var sendDataToDestinationSemi =function(data){
    	
    	var table=$('<table id="dysemitable"></table>');
    	table.append(createTablerows4("SemRoomNo","Reserve_on","Time","Lecturer or Student"));
    	for (var i=0; i < data.length; i++) {
		  		table.append(createTablerows4(data[i].SemRoomNumber,data[i].Reserve_on,data[i].Time,data[i].PERSON));
		  		
		};
    	$("#getsemidetails").append(table);
    		}
    function createTablerows4(a1,a2,a3,a4){
    	var tr = "<tr><td>"+a1+"</td><td>"+a2+"</td><td>"+a3+"</td><td>"+a4+"</td></tr>";
		return tr;
    }
    var sendDataToDestinationhalls =function(data){
    	
    	var table=$('<table id="dysemitable1"></table>');
    	table.append(createTablerows4("HallNo","Reserve_on","Time","Lecturer or Student"));
    	for (var i=0; i < data.length; i++) {
		  		table.append(createTablerows4(data[i].HallNo,data[i].Reserve_on,data[i].Time,data[i].PERSON));
		  		
		};
    	$("#getsemidetailshalls").append(table);
    		}
     var sendDataToDestinationvehicle =function(data){
    	
    	var table=$('<table id="dysemitable2"></table>');
    	table.append(createTablerows4("VehiRegNo","Reserve_on","Time","Lecturer or Student"));
    	for (var i=0; i < data.length; i++) {
		  		table.append(createTablerows4(data[i].VehiRegNumber,data[i].Reserve_on,data[i].Time,data[i].PERSON));
		  		
		};
    	$("#getsemidetailsvehicles").append(table);
    		}
    		
    $("#checkavailability").click(function(){
    	//var availableData="nope";
    	var info=[];
    	var infohalls=[];
    	var infovehicle=[];
    	var te =$("#getsemidetails,#getsemidetailshalls,#getsemidetailsvehicles").html();
    	te="";
    	$("#getsemidetails,#getsemidetailshalls,#getsemidetailsvehicles").html(te);
    	$.ajax({
    		type:"GET",
    		url:"getdata.php",
    		
    		data:info,
    		dataType:'json',
    		success:function(data){
    			sendDataToDestinationSemi(data);
    			
    		}
    		
    		,
    		error:function(XMLHttpRequest,textstatus,errorThrough){
    			//alert("error : "+XMLHttpRequest.responsetext);
    		}
    		
    	});
    	$.ajax({
    		type:"GET",
    		url:"getdatahalls.php",
    		
    		data:infohalls,
    		dataType:'json',
    		success:function(data){
    			sendDataToDestinationhalls(data);
    			
    		}
    		
    		,
    		error:function(XMLHttpRequest,textstatus,errorThrough){
    			//alert("error : "+XMLHttpRequest.responsetext);
    		}
    		
    	});
    	$.ajax({
    		type:"GET",
    		url:"getdatavehicles.php",
    		data:infovehicle,
    		dataType:'json',
    		success:function(data){
    			sendDataToDestinationvehicle(data);
    			
    		}
    		
    		,
    		error:function(XMLHttpRequest,textstatus,errorThrough){
    			//alert("error : "+XMLHttpRequest.responsetext);
    		}
    		
    	});
    });
  });
  
  </script>
  <style>
  
  .ui-tabs-vertical { width: 55em; }
   .ui-tabs-vertical > .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
  .ui-tabs-vertical > .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
  .ui-tabs-vertical > .ui-tabs-nav li a { display:block; }
  .ui-tabs-vertical > .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
  .ui-tabs-vertical > .ui-tabs-panel { padding: 1em; float: right; width: 40em;}
  fieldset { padding:0; border:0; margin-top:25px; }
  .ui-dialog .ui-state-error { padding: .3em; }
  .validateTips { border: 1px solid transparent; padding: 0.3em; }
p { font-size: 10pt; }
h1 { font-weight: bold; }
  #tabs{
  	position:relative;
    margin-top:20px;
    margin-left: 20px;
    height:auto;
    margin-right:100px;
  }
  #titlehead{
  	position:relative;
    margin-top:50px;
    margin-left: 100px;
  }
  </style>
  <h3 id="titlehead" >Online resource allocation system for University (Lecture ,halls, vehicles)</h3>
</head>
<body>
 
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Home</a></li>
    <li id="checkavailability"><a href="#tabs-2">Availability</a></li>
    <li><a href="#tabs-3">Booking</a></li>
  </ul>
  <div id="tabs-1">
    
    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
  </div>
  <div id="tabs-2">
    <div id="tabsHeaders">
  				<ul>
    				<li id="semiid"><a href="#tabs-11">Seminar Rooms</a></li>
    				<li id="lecid"><a href="#tabs-22">Lecture Halls</a></li>
    				<li id="vehiid"><a href="#tabs-33">Vehicles</a></li>
  				</ul>
  			<div id="tabs-11">
    				<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
 			 		<p id="getsemidetails"></p>
 			 </div>
  			<div id="tabs-22">
    				<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie 
    					turpis. </p>
    				<p id="getsemidetailshalls"></p>
  			</div>
  			<div id="tabs-33">
    			<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    			<p id="getsemidetailsvehicles"></p>
  			</div>
</div>
   
  </div>
  <div id="tabs-3">
    
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    <button id="clicktobook">Booking for lectures ...</button>  <button id="clicktobookstudent">Booking for students ...</button>
   
  </div>
  
</div>
<div id="formtofill" title="Booking details">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="formdata">
  <fieldset>
    <label for="nameF">First Name  </label>
    <input type="text" name="nameF" id="nameF" class="text ui-widget-content ui-corner-all"><br/>
    <label for="nameL">Last Name   </label>
    <input type="text" name="nameL" id="nameL" class="text ui-widget-content ui-corner-all"><br/>
    <label for="email">Email       </label>
    <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all"><br/>
    <label for="TelephoneNumber">Telephone Number</label>
    <input type="text" name="TelephoneNumber" id="TelephoneNumber" value="" class="text ui-widget-content ui-corner-all"><br/>
    <label for="department" id="depatlable">Department</label>
    <input type="text" name="department" id="department" value="" class="text ui-widget-content ui-corner-all"><br/>
    <label for="RegNumber" id="reglable">RegNumber </label>
    <input type="text" name="RegNumber" id="RegNumber" value="E/10/111" class="text ui-widget-content ui-corner-all"><br/>
    <label for="NameofAssociation" id="assolable">Name of Association</label>
    <input type="text" name="NameofAssociation" id="NameofAssociation" value="" class="text ui-widget-content ui-corner-all"><br/>
    <br/>
  
    <div id="tabsHeadersofBooking">
  				<ul>
    				<li><a href="#tabs-111">Seminar Rooms</a></li>
    				<li><a href="#tabs-222">Lecture Halls</a></li>
    				<li><a href="#tabs-333">Vehicles</a></li>
  				</ul>
  			<div id="tabs-111">
    				<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc.</p>
    				<p>Date: <input type="text" id="datepicker" size="15" ></p>
    				<p>Time: <input type="text" id="timepicker" size="15" value="12:34pm" > Diration : <input type="text" id="durationpicker" size="15" value="2hours ">hours </p>
    				<p>Room Number :<select id="selectedIdSemi">
  						<option value="1">1</option>
  						<option value="2">2</option>
  						<option value="3">3</option>
  				  </select><div id="radio11"> <input type="checkbox" id="radio1" name="radio" /><label for="radio1" id="ra1">Click to Book</label></div></P>
 			 </div>
  			<div id="tabs-222">
    				<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque
    					 molestie turpis. </p>
    			    
    				<p>Date: <input type="text" id="datepickerhalls" size="15" ></p>
    				<p>Time: <input type="text" id="timepickerhalls" size="15" value="12:34pm" > Diration : <input type="text" id="durationpickerhalls" size="15" value="2hours " >hours </p>
    				<p>Room Number :<select id="selectedIdhalls">
  						<option value="09">09</option>
  						<option value="10">10</option>
  						<option value="11">11</option>
  				    </select><div id="radio22"> <input type="checkbox" id="radio2" name="radio" /><label for="radio2" id="ra2">Click to Book</label></div></P>
  			</div>
  			<div id="tabs-333">
    			<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque </p>
    			<p>Date: <input type="text" id="datepickervehicles" size="15" ></p>
    				<p>Time: <input type="text" id="timepickervehicles" size="15" value="12:34pm" > Capacity : <input type="text" id="pickervehicles" size="15" value="23 " >people </p>
    				<p>Vehicle :<select id="selectedIdvehicles">
  						<option value="car1">car1</option>
  						<option value="car2">car2</option>
  						<option value="car3">car3</option>
  				    </select><div id="radio33"> <input type="checkbox" id="radio3" name="radio" /><label for="radio3" id="ra3">Click to Book</label></div></P>
  			</div>
    </div>
  </fieldset>
  </form>
</div> 

</body>
</html>