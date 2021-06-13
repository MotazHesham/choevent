 
    <div class="copyright"> 
        <div class="container"> 
            <div class="row">
                <div class="col-md-6">© 2020 {{ trans('website.footer.all_rights_reserved') }} CHOCIES</div>
                <div class="col-md-6">
                <div class="social-icons">
                <a href="https://twitter.com/choices_events?s=11" target="_blank"> <i class="fab fa-twitter"></i> </a>
                {{-- <a href="#" target="_blank"><i class="fab fa-facebook"></i> </a> --}}

                <a href="https://instagram.com/choices_events?igshid=sgryu58jzn5p"  title="instagram"  target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/in/choices-events-8522a01b7/" target="_blank"> <i class="fab fa-linkedin"></i> </a>
            </div>
                </div>
            </div>
        </div>
      </div>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>
  <script id="rendered-js">
  var swiper = new Swiper('.blog-slider', {
    spaceBetween: 10,
    effect: 'fade',
    loop: true,
       loop: true,
    mousewheel: {
      invert: true },
  
    // autoHeight: true,
    pagination: {
      el: '.blog-slider__pagination',
      clickable: true } });
  //# sourceURL=pen.js
      </script>
  
       <script>
      $(function() {
      //----- OPEN
      $('[data-popup-open]').on('click', function(e)  {
          var targeted_popup_class = jQuery(this).attr('data-popup-open');
          $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
   
          e.preventDefault();
      });
   
      //----- CLOSE
      $('[data-popup-close]').on('click', function(e)  {
          var targeted_popup_class = jQuery(this).attr('data-popup-close');
          $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
   
          e.preventDefault();
      });
  });
  </script>
  
    <div class="popup" data-popup="popup-1">
        <div class="popup-inner sponsors_inner">
            <div class="row">
                <div class="col-md-6">
                    <div class="home-search">
                        <div class="form-group">
                            <label>اسم الفعالية </label>
                            <input type="text" class="form-control" id="event-name" placeholder="اسم الفعالية " required="" autofocus="">
                        </div>
                    <div class="form-group">
                        <label>  مكان الفعالية</label>
                        <select class="form-control" style="padding:2%"id="search-city-id"  >
                          <option value="">اختر مكان الفاعلية</option> 
                          @foreach($cities as $id=>$city)
                          <option value="{{$id}}">{{$city}}</option>
                         @endforeach
                        </select>
                    </div>      
                    <div class="form-group">
                        <label> نوع الفعالية</label>
                        <select class="form-control" style="padding:2%" id="search-category-id"  > 
                          <option value=""> اختر نوع الفعالية</option>
                          @foreach($activites as $id=>$activity)
                            <option value="{{$id}}">{{$activity}}</option>
                           @endforeach
                        </select>
                    </div>
                </div>
            </div>
           <div class="col-md-6">
                <div class="calendar-search">
                    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
                    <div class="tile" id="tile-calendar">
                        <table class="calendar">
                            <tr class="calendar-month">
                                <td colspan="7">
                                <div class="calendar-nav-month" id="prev_month" onclick="SetDays(-1)"><span class="fa fa-angle-left"></span></div>
                                <span id="month"></span>
                                <div class="calendar-nav-month" id="next_month" onclick="SetDays(1)"><span class="fa fa-angle-right"></span></div>
                                </td>
                            </tr>
                            <tr class="calendar-days">
                                <td class="calendar-day">Sun</td>
                                <td class="calendar-day">Mon</td>
                                <td class="calendar-day">Tue</td>
                                <td class="calendar-day">Wed</td>
                                <td class="calendar-day">Thu</td>
                                <td class="calendar-day">Fri</td>
                                <td class="calendar-day">Sat</td>
                            </tr>
                            <tbody id="calendar-days-group">
                                <tr> <td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                                <tr> <td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                                <tr> <td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                                <tr> <td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                                <tr> <td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                                <tr> <td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                            </tbody>
                        </table>
                        <table class="event-group" id="events">
                            <tr class="event">
                                <td class="event-image">
                                    <img src="https://tse1.mm.bing.net/th?id=OIP.Me274a23e362234e96f8fa2898b0d944cH0&w=176&h=176&c=7&rs=1&qlt=90&o=4&pid=1.1"/>
                                </td>
                                <td class="event-details">
                                    <div class="event-name">Test event</div>
                                    <div class="event-time">12-2PM Lindon</div>
                                </td>
                            </tr>
                        </table>
                    </div>

               
<script>
    var events = {"events" : [
      { "name" : "Test Event #1",
        "time" : "12-3PM",
        "location" : "Orem",
        "date" : "2016-02-27"
      },
        { "name" : "Test Event #2",
        "time" : "10-12PM",
        "location" : "Provo",
        "date" : "2016-02-27"
      }
    ]
  }
  var calendar_event = events.events;
  var c = $(".calendar");
  var today = new Date();
  today.setHours(0)
  var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var month =  today.getMonth();
    var year =  today.getFullYear();
    
    function init() {
      LoadCalendar(0);
    }
    function SetDays(step){
      month=(step==1)? ++month:--month;
      init();
    }
  
   // todo - separate into 2 functions: 1) load 2) changemonth
  function LoadCalendar(adv) {
    if ((month + adv) < 0) {
      year--;
      month = 11;
    } else if ((month + adv) > 11 ) {
      year++;
      month = 0;
    }else month += adv;
    
    $('#month').text(months[month] + " " + year);
    
    var first_day = new Date(year, month, 1);
    var itr_date = first_day;
    var last_day = new Date(year, month, 0);
    
    while (itr_date.getDay() != 0) {
      itr_date.setDate(itr_date.getDate() - 1);
    }
    
    $('#calendar-days-group td').each(function() {
      $(this).html('<div class="calendar-date" data-date="' + itr_date + '">' + itr_date.getDate() + '</div>')
      //console.log(itr_date + " " + itr_date.getMonth() + ' ' + month)
      $(this).attr('class', '');
      if (itr_date.getMonth() == month) {
        $(this).addClass('current_month');
        if (itr_date.getDate() === today.getDate() && itr_date.getMonth() === today.getMonth() && itr_date.getYear() === today.getYear()) {
          $(this).addClass('today');
        }
      } else { $(this).addClass('other_month'); }
      
      itr_date.setDate(itr_date.getDate() + 1)
    })
  }
  
  function LoadEvents(date) {
    var html = ""
    
    for (var i = 0; i < calendar_event.length; i++) {
      var event_date = new Date(calendar_event[i].date);
      event_date.setDate(event_date.getDate() + 1);
  
      if (isSameDay(event_date,date)) {
        html += "<tr class=\"event\">"
              + "<td class=\"event-image\">"
              + "<img src=\"https://tse1.mm.bing.net/th?id=OIP.Me274a23e362234e96f8fa2898b0d944cH0&w=176&h=176&c=7&rs=1&qlt=90&o=4&pid=1.1\"/>"
              + "</td>"
              + "<td class=\"event-details\">"
              + "<div class=\"event-name\">" + calendar_event[i].name + "</div>"
              + "<div class=\"event-time\">" + calendar_event[i].time + " " + calendar_event[i].location + "</div>"
              + "</td>"
              + "</tr>";
      }
    } 
    $('#events').html(html);
  }
  
  function isSameDay(d1, d2) {
    var date1 = new Date(d1);
    var date2 = new Date(d2);
    console.log(date1 + "   " + date2)
    if (date1.getYear() == date2.getYear() && date1.getMonth() == date2.getMonth() && date1.getDate() == date2.getDate()) {
      console.log('isSame: true')
      return true;
    }
    return false;
  }
  
  function SimpleDate(d) {
    var date = new Date(d)
    return date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate();
  }
  
  init();
  LoadEvents(today);
  
  /* Event Listeners --------------------------- */
  $('.calendar-date').click(function () {
    $('.calendar-date').removeClass('active');
    $(this).addClass('active');
    var date = $(this).data('date');
  
    LoadEvents(date);
  })
  
  
  
  
               </script>
               
               
               </div>
               <br />
                      <button type="button" class="btn btn-primary next-step" id="search-btn">بحث </button>         
  
           </div>
          </div>
          
          <a class="popup-close " data-popup-close="popup-1" href="#">x</a>
      </div>
      
      
  </div>
  
      
      <!--------serch------------>
      
      <!---------events slider------>
      
        <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
  
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
    
        <script id="rendered-js" >
  $(document).ready(function () {
    var owl = $("#slider-carousel");
    owl.owlCarousel({
      items: 3,
      itemsDesktop: [1000, 3],
      itemsDesktopSmall: [900, 2],
      itemsTablet: [600, 1],
      itemsMobile: false,
      pagination: false });
  
    $(".next").click(function () {
      owl.trigger('owl.next');
    });
    $(".prev").click(function () {
      owl.trigger('owl.prev');
    });
  });
  //# sourceURL=pen.js
      </script>
      
      <!---------events slider------>
  
        <script id="rendered-js" >
  $(document).ready(function () {
    var owl = $("#event-carousel");
    owl.owlCarousel({
      items: 2,
      itemsDesktop: [1000, 2],
      itemsDesktopSmall: [900, 2],
      itemsTablet: [600, 1],
      itemsMobile: false,
      pagination: false });
  
    $(".eventnext").click(function () {
      owl.trigger('owl.next');
    });
    $(".eventprev").click(function () {
      owl.trigger('owl.prev');
    });
  });
  //# sourceURL=pen.js

      </script>
      <script>
        var eventDate='';
          $('#calendar-days-group tr td').click(function(){
            eventDate=new Date($(this).children()[0].dataset.date);
        });
        $('#search-btn').click(function(e){
      let eventName=$('#event-name').val();
      let city=$('#search-city-id').val();
      let category=$('#search-category-id').val();
      let date =(eventDate)?eventDate.getDate() + "-" + (eventDate.getMonth() + 1) + "-" +eventDate.getFullYear():'';
      // e.preventDefault();
      let url="{{route('website.events.search')}}";
      window.open(url+"?name="+eventName+"&city_id="+city+"&category_id="+category+"&date="+date,"_self");
     
  });
      </script>
  
  @yield('scripts')
      