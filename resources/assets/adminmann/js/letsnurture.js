// Live Dashboard User Code
$(function () {
    displayVisitor($("#art_detail_id").val(),$("#art_type_detail").val());
    displayUserInfo($("#art_detail_id").val(),$("#art_type_detail").val(),$("#page_type").val());
    displayMorrisData($("#art_detail_id").val(),$("#graph_detail").val());
    displayLeaderboard($("#art_detail_id").val());
    setInterval(function() {
       var currentTime = new Date();
       var currentHours = currentTime.getHours ( );
       var currentMinutes = currentTime.getMinutes ( );
       var currentSeconds = currentTime.getSeconds ( );
       currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
       currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
       var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
       currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
       currentHours = ( currentHours == 0 ) ? 12 : currentHours;
       var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
       document.getElementById("timer").innerHTML = currentTimeString;
    }, 1000);
    setInterval(function() {
       var currentTime = new Date();
       var currentHours = currentTime.getHours ( );
       var currentMinutes = currentTime.getMinutes ( );
       var currentSeconds = currentTime.getSeconds ( );
       currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
       currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
       var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
       currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
       currentHours = ( currentHours == 0 ) ? 12 : currentHours;
       var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
       document.getElementById("timer1").innerHTML = currentTimeString;
    }, 1000);
    var selectType = $("select.select_art_detail option:first").attr("id");
    $(".art_name_display").html(selectType);
    $("#art_detail_id").val($("select.select_art_detail option:first").val());
    $("select.select_art_detail").on('change',function(){
        var selectType = $(this).children(":selected").attr("id");
        var selectValue = $(this).children(":selected").val();
        if(selectType){
           $(".art_name_display").html(selectType);
           $("#art_detail_id").val(selectValue);
           displayVisitor($("#art_detail_id").val(),$("#art_type_detail").val());
           displayUserInfo($("#art_detail_id").val(),$("#art_type_detail").val(),$("#page_type").val());
        }
    });

    setInterval(function() {
          displayVisitor($("#art_detail_id").val(),$("#art_type_detail").val());
    }, 1500);

    setInterval(function() {
          displayUserInfo($("#art_detail_id").val(),$("#art_type_detail").val(),$("#page_type").val());
    }, 1800);

    $(document).on('click','.page_click',function(){
        var pageNumber = $(this).attr('id');
        $("#page_type").val(pageNumber);
    });

    setInterval(function() {
          displayMorrisData($("#art_detail_id").val(),$("#graph_detail").val());
    }, 3000);

    setInterval(function() {
          displayLeaderboard($("#art_detail_id").val());
    }, 1900);
});

function displayLeaderboard(art_id){
  var htmlleaderboarddata = '';
  var userLeaderboardString = '{"data":{"art_id" : "'+art_id+'"}}';
  $.ajax({
      type: 'POST',
      url: '//letsnurture.co.uk/demo/museum/api/getuserLeaderboard/LeaderboardInfomation',
      dataType: 'json',
      data: userLeaderboardString,
      beforeSend: function(data){
        //loader("on"); //Before Loader
      },
      success:function(userLeaderboardListing) {
              if(userLeaderboardListing.status == '1'){
                    for(var i=0;i<userLeaderboardListing.data.length;i++){
                       htmlleaderboarddata = htmlleaderboarddata + '<tr><td class="leaderboard_art_name"><a href="//letsnurture.co.uk/demo/museum/admin/artdetail/view/'+$("#art_detail_id").val()+'">'+userLeaderboardListing.data[i].art_name+'</a></td>';
                       htmlleaderboarddata = htmlleaderboarddata + '<td class="leaderboard_male" style="text-align:center;"><span class="badge bg-aqua">'+userLeaderboardListing.data[i].total_male+'</span></td>';
                       htmlleaderboarddata = htmlleaderboarddata + '<td class="leaderboard_male" style="text-align:center;"><span class="badge bg-aqua">'+userLeaderboardListing.data[i].total_female+'</span></td>';
                       htmlleaderboarddata = htmlleaderboarddata + '<td class="leaderboard_male" style="text-align:center;"><span class="badge bg-aqua">'+userLeaderboardListing.data[i].total_user+'</span></td>';
                       htmlleaderboarddata = htmlleaderboarddata + '<td class="leaderboard_time" style="text-align:center;"><div class="sparkbar" data-color="#00a65a" data-height="20">'+userLeaderboardListing.data[i].time+'</div></td></tr>';
                    }
                    $("#leader_dynamic_data").html(htmlleaderboarddata);
              }else{
                  htmlleaderboarddata = htmlleaderboarddata + '<tr><td>'+userLeaderboardListing.data+'</td></tr>';
                  $("#leader_dynamic_data").html(htmlleaderboarddata);
              }
      },
  });
}

$(".pull-right").click(function(){
    var currentType = $(this).text();
    if(currentType == 'Day'){
        $("#Day").addClass('selected');
        $("#Week").removeClass('selected');
        $("#Month").removeClass('selected');
        $("#Year").removeClass('selected');
        $("#art_type_detail").val(currentType);
    }
    if(currentType == 'Week'){
        $("#Day").removeClass('selected');
        $("#Week").addClass('selected');
        $("#Month").removeClass('selected');
        $("#Year").removeClass('selected');
        $("#art_type_detail").val(currentType);
    }
    if(currentType == 'Month'){
        $("#Day").removeClass('selected');
        $("#Week").removeClass('selected');
        $("#Month").addClass('selected');
        $("#Year").removeClass('selected');
        $("#art_type_detail").val(currentType);
    }
    if(currentType == 'Year'){
        $("#Day").removeClass('selected');
        $("#Week").removeClass('selected');
        $("#Month").removeClass('selected');
        $("#Year").addClass('selected');
        $("#art_type_detail").val(currentType);
    }
    if(currentType == 'CURRENT MONTH'){
        $("#Current").addClass('selected');
        $("#6Month").removeClass('selected');
        $("#1Year").removeClass('selected');
        $("#graph_detail").val(currentType);
    }
    if(currentType == '6 MONTH'){
        $("#Current").removeClass('selected');
        $("#6Month").addClass('selected');
        $("#1Year").removeClass('selected');
        $("#graph_detail").val(currentType);
    }
    if(currentType == 'YEAR'){
        $("#Current").removeClass('selected');
        $("#6Month").removeClass('selected');
        $("#1Year").addClass('selected');
        $("#graph_detail").val(currentType);
    }
});

$("#refresh_button").click(function(){
      displayUserInfo($("#art_detail_id").val(),$("#art_type_detail").val(),$("#page_type").val());
});

function displayMorrisData(art_id,type){
      var userMorrisString = '{"data":{"art_id" : "'+art_id+'","type" : "'+type+'"}}';
      $.ajax({
          type: 'POST',
          url: '//letsnurture.co.uk/demo/museum/api/getuserMorris/MorrisInfomation',
          dataType: 'json',
          data: userMorrisString,
          beforeSend: function(data){
            //loader("on"); //Before Loader
          },
          success:function(data) {
                $(".total_users_month").val(data.male+data.female);
                $(".male_users_month").val(data.male);
                $(".female_users_month").val(data.female);
                $("#total_users_month").val(data.male+data.female);
                $("#male_users_month").val(data.male);
                $("#female_users_month").val(data.female);
                //-------------
                //- PIE CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
                var pieChart = new Chart(pieChartCanvas);
                var PieData = [
                  {
                    value: $("#male_users_month").val(),
                    color: "#00a65a",
                    highlight: "#00a65a",
                    label: "Total Male"
                  },
                  {
                    value: $("#female_users_month").val(),
                    color: "#f39c12",
                    highlight: "#f39c12",
                    label: "Total Female"
                  }
                ];
                var pieOptions = {
                  //Boolean - Whether we should show a stroke on each segment
                  segmentShowStroke: true,
                  //String - The colour of each segment stroke
                  segmentStrokeColor: "#fff",
                  //Number - The width of each segment stroke
                  segmentStrokeWidth: 2,
                  //Number - The percentage of the chart that we cut out of the middle
                  percentageInnerCutout: 50, // This is 0 for Pie charts
                  //Number - Amount of animation steps
                  animationSteps: 100,
                  //String - Animation easing effect
                  animationEasing: "easeOutBounce",
                  //Boolean - Whether we animate the rotation of the Doughnut
                  animateRotate: false,
                  //Boolean - Whether we animate scaling the Doughnut from the centre
                  animateScale: false,
                  //Boolean - whether to make the chart responsive to window resizing
                  responsive: true,
                  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                  maintainAspectRatio: true,
                  //String - A legend template
                  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
                };
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                pieChart.Doughnut(PieData, pieOptions);
                /*var line = new Morris.Area({
                    element: 'line-chart',
                    resize: true,
                    data: [data],
                    xkey: 'y',
                    ykeys: ['male', 'female'],
                    labels: ['Male', 'Female'],
                    lineColors: ['#a0d0e0', '#3c8dbc'],
                    hideHover: 'auto'
                });*/
          },
      });
}


function displayUserInfo(art_id,type,page){
      var htmluserinfo = '';
      var paginationhtml = '';
      var userInfoString = '{"data":{"art_id" : "'+art_id+'","type" : "'+type+'","page" : "'+page+'"}}';
      $.ajax({
          type: 'POST',
          url: '//letsnurture.co.uk/demo/museum/api/getUserInfo/userInfomation',
          dataType: 'json',
          data: userInfoString,
          beforeSend: function(data){
            //loader("on"); //Before Loader
          },
          success:function(userInfoListing) {
                  if(userInfoListing.status == '1'){
                      //if(userInfoListing.total_record > 1){
                      paginationhtml = paginationhtml + '<li><a href="javascript:;" class="page_click" id="1">&laquo;</a></li>';
                      for(var j = userInfoListing.first; j <= userInfoListing.last; j++){
                          paginationhtml = paginationhtml + '<li><a href="javascript:;" class="page_click" id="'+j+'">'+j+'</a></li>';
                      }
                      paginationhtml = paginationhtml + '<li><a href="javascript:;" class="page_click" id="'+userInfoListing.last+'">&raquo;</a></li>';
                      //}
                      $("#pagination_html").html(paginationhtml);

                      for(var i=0;i<userInfoListing.data.length;i++){
                           htmluserinfo = htmluserinfo + '<li><span class="handle"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span>';
                           htmluserinfo = htmluserinfo + '<span class="text"><a href="//letsnurture.co.uk/demo/museum/admin/userdetail/view/'+userInfoListing.data[i].user_id+'">'+userInfoListing.data[i].username+'</a>- '+userInfoListing.data[i].gender+'</span>';
                           htmluserinfo = htmluserinfo + '<small class="label label-success"><i class="fa fa-clock-o"></i> '+relative_time(userInfoListing.data[i].visit_start_date)+'</small>';
                           htmluserinfo = htmluserinfo + '</li>';
                      }
                      $("#visitor_information").html(htmluserinfo);
                  }else{
                      htmluserinfo = htmluserinfo + userInfoListing.data;
                      $("#visitor_information").html(htmluserinfo);
                  }
          },
      });
}

function relative_time(date_str) {
    if (!date_str) {return;}
    date_str = $.trim(date_str);
    date_str = date_str.replace(/\.\d\d\d+/,""); // remove the milliseconds
    date_str = date_str.replace(/-/,"/").replace(/-/,"/"); //substitute - with /
    date_str = date_str.replace(/T/," ").replace(/Z/," UTC"); //remove T and substitute Z with UTC
    date_str = date_str.replace(/([\+\-]\d\d)\:?(\d\d)/," $1$2"); // +08:00 -> +0800
    var parsed_date = new Date(date_str);
    var relative_to = (arguments.length > 1) ? arguments[1] : new Date(); //defines relative to what ..default is now
    var delta = parseInt((relative_to.getTime()-parsed_date)/1000);
    delta=(delta<2)?2:delta;
    var r = '';
    if (delta < 60) {
    r = delta + ' seconds ago';
    } else if(delta < 120) {
    r = 'a minute ago';
    } else if(delta < (45*60)) {
    r = (parseInt(delta / 60, 10)).toString() + ' minutes ago';
    } else if(delta < (2*60*60)) {
    r = 'an hour ago';
    } else if(delta < (24*60*60)) {
    r = '' + (parseInt(delta / 3600, 10)).toString() + ' hours ago';
    } else if(delta < (48*60*60)) {
    r = 'a day ago';
    } else {
    r = (parseInt(delta / 86400, 10)).toString() + ' days ago';
    }
    return 'About ' + r;
};

function displayVisitor(art_id,type){
  var htmluserdata = '';
  var userDataString = '{"data":{"art_id" : "'+art_id+'","type" : "'+type+'"}}';
  $.ajax({
      type: 'POST',
      url: '//letsnurture.co.uk/demo/museum/api/getUserData/getUserInfo',
      dataType: 'json',
      data: userDataString,
      beforeSend: function(data){
        //loader("on"); //Before Loader
      },
      success:function(userDataListing) {
              if(userDataListing.status == '1'){
                    $("#live_total_user").html(userDataListing.data.total_users);
                    $("#male_total_data").html(userDataListing.data.total_male);
                    $("#female_total_data").html(userDataListing.data.total_female);
              }
      },
  });
}
