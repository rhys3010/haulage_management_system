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

  $('#journeysTable').DataTable({
    "ajax": "/journeys/view/data",
    "search": {
      "search": getSearchParam()['search']
    },
    "columnDefs": [{
      "targets": -1,
      "width": "1%",
      "data": null,
      "defaultContent": "<a class='btn btn-primary btn-sm' href='/dashboard'>View</a>",
    }]
  });

  $('#dataTable').DataTable();

  $('.spinner').hide();
});
