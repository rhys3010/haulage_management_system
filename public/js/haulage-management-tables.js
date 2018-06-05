// Get the search param from URL query string
function getSearchParam(){
  var vars = [], hash;
  var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
  for(var i = 0; i < hashes.length; i++)
  {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
  }
  return vars;
}

// Call the dataTables jQuery plugin
$(document).ready(function() {

  $('#hauliersTable').DataTable({
    "search": {
      "search": getSearchParam()['search']
    },
    "columnDefs": [
      { "width" : "10%", "targets": 3 },
      { "width" : "1%", "targets": 4},
    ]
  });

  $('#usersTable').DataTable({
    "columnDefs": [
      { "width" : "1%", "targets": 5},
    ]
  });

  var journeysTable = $('#journeysTable').DataTable({
    "order": [[ 4, 'desc' ]],
    "ajax": "/journeys/view/data",
    "search": {
      "search": getSearchParam()['search']
    },
    "columnDefs": [{
      "targets": -1,
      "width": "1%",
      "data": null,
      "defaultContent": "<a class='btn btn-primary btn-sm text-white'>View Journey</a>",
    }]
  });

  $('#journeysTable tbody').on('click', 'a', function(){
    var data = journeysTable.row($(this).parents('tr')).data();
    document.location.href = '/journeys/view/'+data[0];

  });

  $('.spinner').hide();
});
