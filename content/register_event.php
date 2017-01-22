<?php

function is_going($reservations, $date, $hour) {
    if (array_key_exists($date, $reservations)) {
        $hours = $reservations[$date];
        if (array_key_exists($hour, $hours)) {
            return $hours[$hour] ? "yes" : "no";
        }
    }
    return "maybe";
}

function display_square($reservations, $event_date_id, $date, $hour, $input_field) {
    $input_name = "h_{$event_date_id}_{$date}_{$hour}";
    $is_going = is_going($reservations, $date, $hour);
    if ($is_going === "yes") {
        $td_class = "going";
        $icon = "icon-ok-sign";
        $value = 1;
    }
    else if ($is_going === "no") {
        $td_class = "not-going";
        $icon = "icon-remove-sign";
        $value = 0;   
    }
    else {
        $td_class = "not-sure";
        $icon = "";
        $value = -1;      
    }
    if ($input_field) {
        $td_class = "changeable " . $td_class;
    }
    return "<td class=\"{$td_class}\">" .
        "<i class=\"$icon\"></i>" .
        ($input_field ? "<input type=\"hidden\" name=\"$input_name\" value=\"$value\" />" : "") .
        "</td>";
}

$event = Event::find($_GET["id"]);
if (!$event) {
    die("Event does not exist.");
}

if (!$event->userIsInvited($user->id)) {
    die("You are not invited for this event.");
}


if (!empty($_POST)) {
    $event->deleteAllReservationsFor($user->id);
    $availabilities = array();
    foreach ($_POST as $date_time => $can_go) {
        if ($can_go != -1) {
            $can_go_sql = $can_go == "1" ? 1 : 0;
            list($ignore, $id, $date, $hour) = explode("_", $date_time);
            $availabilities[] = "({$user->id}, $id, '$hour:00:00', $can_go_sql)";
        }
    }
    $availabilities_string = implode(", ", $availabilities);
    $event->insertAvailabilities($availabilities_string);
}

$event_dates = $event->dates();
$invitees = array_diff($event->getInvitees(), array($user->id));
$my_reservations = $event->getReservationsFor($user->id);
$others_reservations = array();
foreach ($invitees as $invitee) {
    list($invitee_id, $invitee_name) = $invitee;
    if ($invitee_id == $user->id) {
        continue;
    }
    $others_reservations[$invitee_name] = $event->getReservationsFor($invitee_id);
}
$c = count($event_dates);
?>



<div class="container">

	<div class="row">
    <h1><?php echo $event->name ?> (<?php echo $event->duration ?> Hour<?php echo $event->duration > 1 ? "s" : "" ?>)</h1>
    <h3>Created by: <?php echo $event->organizer_name ?></h3>

        <form id="new_event_form" class="form-horizontal" method="post" action="">
	        <legend>Availability</legend>

            <table id="my-availabilities" border="1">
                <tr>
                    <th>&nbsp;</th>
                    <?php for ($h = 0; $h < 24; $h++): ?>
                    <th class="reservation-hour">
                        <?php printf("%2dh", $h) ?>
                    </th>
                    <?php endfor ?>

                    <?php for ($i = 0; $i < $c; $i++): ?>
                    <tr>
                        <th class="reservation-date"><?php echo $event_dates[$i]["date"] ?></th>
                        <?php for ($h = 0; $h < 24; $h++): ?>
                            <?php if ($h >= $event_dates[$i]["start_hour"] && $h < $event_dates[$i]["end_hour"]): ?>
                            <?php echo display_square($my_reservations, $event_dates[$i]['id'], $event_dates[$i]["date"], $h, TRUE) ?>
                            <?php else: ?>
                            <td class="no-reservation">&nbsp;</td>
                            <?php endif ?>
                        <?php endfor ?>
                    </tr>
                    <?php endfor 
                    ?>
                </tr>
            </table>
                     <?php 
            $id=$_GET["id"];
             ?>
              <?php if(($user->id) == ($event->organizer)){
        $sup=$id;
        $org=$event->organizer;
    }
    else

        $sup="no";

      
        //echo $user->is_admin;

    ?>
<?php if ($user->is_admin) $sup=$id;


 ?>



                       <input type="submit" class="btn btn-success" value="Enregistrer" />
                       <input type="button" class="btn btn-warning" value="Modifier Event" onClick=" modifEvt('<?php echo $sup?>')"/>
                 <input type="button" class="btn btn-danger" value="Supprimer Event" onClick=" delEvt('<?php echo $sup?>')"/>
            
            
        </form>

        <h1>Invited People</h1>
        <?php if ($event->type == 'private'): ?>
        <div class="alert">
           Sorry this event is private, you can not see the invited people.
        </div>
        <?php endif ?>
        <?php foreach ($others_reservations as $invitee_name => $reservations): ?>
        <?php if ($event->type === 'public'): ?>
        <legend><?php echo $invitee_name ?></legend>
        <?php endif ?>

        <table border="1">
            <tr>
                <th>&nbsp;</th>
                <?php for ($h = 0; $h < 24; $h++): ?>
                <th class="reservation-hour">
                    <?php printf("%2dh", $h) ?>
                </th>
                <?php endfor ?>

                <?php for ($i = 0; $i < $c; $i++): ?>
                <tr>
                    <th class="reservation-date"><?php echo $event_dates[$i]["date"] ?></th>
                    <?php for ($h = 0; $h < 24; $h++): ?>
                        <?php if ($h >= $event_dates[$i]["start_hour"] && $h < $event_dates[$i]["end_hour"]): ?>
                        <?php echo display_square($reservations, $event_dates[$i]["id"], $event_dates[$i]["date"], $h, FALSE) ?>
                        <?php else: ?>
                        <td class="no-reservation">&nbsp;</td>
                        <?php endif ?>
                    <?php endfor ?>
                </tr>
                <?php endfor ?>
            </tr>
        </table>
        <?php endforeach ?>
    </div>
</div>
<div id="modifEvt" name="modifEvt" style="display: none;"> <?php  include('content/newAcc.php');?> </div>
<div id="modifEvt2" name="modifEvt2" style="display: none;"> <?php  include('content/index.php');  ?> </div>
<script>

function modifEvt(id){
    

  if(id!="no"){
    // var data = { event_id: event_row.data('id') };
        //alert(id);
        //alert(test);
       
       var data={event_id:id};

    $("#modifEvt").show("slow");
    $("#leg").text("Modify the event.");
    $("#save-event").html('Mettre a jour');
    var titreR='<?php echo $event->name;?>';
    var descR='<?php echo $event->description;?>';
    var duR='<?php echo $event->duration;?>';
    var typeR='<?php echo $event->type;?>';
    $("#title").attr('value', titreR);
    $("#description").attr('value',descR );
    $("#duration").attr('value', duR);
    $("#type").attr('value',typeR );
    //delEvt(id);


    //alert("allo");
  

 
}else{
     $("#title").attr('value', '<?php echo $event->name;?>');
    $("#description").attr('value', '<?php echo $event->description;?>');
    $("#duration").attr('value', '<?php echo $event->duration;?>');
    $("#type").attr('value', '<?php echo $event->type;?>');
    alert("you can not edit an event that you did not create.");
}
    }
function delEvt(id ){
 
if(id!="no"){
    // var data = { event_id: event_row.data('id') };
        //alert(id);
        //alert(test);
       
       var data={event_id:id};
            $.ajax({
                url: "admin/delete_event.php",
                type: "POST",
                data: data,
                success: function(msg) {
                    if(msg) {

                       var msg="tres bien";
                    $('#new_event_form').parent()
                           .prepend('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> Event does not exist because it may have been deleted.</div>');
                          location.href = "index.php"                }
                }
            });
}


else{
    alert("You can not delete an event that you did not created.");
}
    
}
$(function () {
    var properties = {
        "0": ["not-sure", "", "-1"],
        "1": ["not-going", "icon-remove-sign", "0"],
        "-1": ["going", "icon-ok-sign", "1"],
    };
    $("#my-availabilities .changeable").click(function () {
        var td = $(this);
        var currentClass = td.prop("class").split(" ")[1]; // Yuck.
        var icon = td.find("i");
        var currentIcon = icon.prop("class");
        var hidden = td.find("input");
        var currentValue = hidden.prop("value");

        var nextProperties = properties[currentValue];
        td.removeClass(currentClass);
        icon.removeClass(currentIcon);
        td.addClass(nextProperties[0]);
        icon.addClass(nextProperties[1]);
        hidden.prop("value", nextProperties[2]);
    });
});
</script>
