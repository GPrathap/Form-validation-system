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
    	table.append(createTablerows("SemRoomNo","Capacity","Availability","Reserve_on","Time","Duration"));
    	for (var i=0; i < data.length; i++) {
		  		table.append(createTablerows(data[i].SemRoomNo,data[i].Capacity,data[i].Availability,data[i].Reserve_on,data[i].Time,data[i].Duration));
		  		
		};
    	$("#getsemidetails").append(table);
    		}
    function createTablerows4(a1,a2,a3,a4){
    	var tr = "<tr><td>"+a1+"</td><td>"+a2+"</td><td>"+a3+"</td><td>"+a4+"</td></tr>";
		return tr;
    }
    var sendDataToDestinationhalls =function(data){
    	
    	var table=$('<table id="dysemitable1"></table>');
    	table.append(createTablerows("HallNo","Capacity","Projectors","Availability","Reserve_on","Time","Duration"));
    	for (var i=0; i < data.length; i++) {
		  		table.append(createTablerows(data[i].HallNo,data[i].Capacity,data[i].Projectors,data[i].Availability,data[i].Reserve_on,data[i].Time,data[i].Duration));
		  		
		};
    	$("#getsemidetailshalls").append(table);
    		}
     var sendDataToDestinationvehicle =function(data){
    	
    	var table=$('<table id="dysemitable2"></table>');
    	table.append(createTablerows("VehiRegNo","Capacity","Type","Availability","Reserve_on","Time"));
    	for (var i=0; i < data.length; i++) {
		  		table.append(createTablerows(data[i].VehiRegNo,data[i].Capacity,data[i].Type,data[i].Availability,data[i].Reserve_on,data[i].Time));
		  		
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
  