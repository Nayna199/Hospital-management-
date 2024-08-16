$(document).ready(function() {
    function fetchAllPatients(page) {
        $.ajax({
            url: 'fetch_all_patients.php',
            type: 'GET',
            data: { page: page },
            dataType: 'json',
            success: function(data) {
                console.log('Ajax success. Data:', data);

                $('#patientTableBody').empty();

                if (data.length > 0) {
                    $.each(data, function(index, patient) {
                        var row = '<tr>';
                        row += '<td>' + patient.id + '</td>';
                        row += '<td>' + patient.first_name + '</td>';
                        row += '<td>' + patient.last_name + '</td>';
                        row += '<td>' + patient.email + '</td>';
                        row += '<td>' + patient.phone_number + '</td>';
                        row += '<td>' + patient.gender + '</td>';
                        row += '<td>' + patient.tests + '</td>';
                        console.log('Profile Image Path:', patient.profile_image);
                        row += '<td><img src="uploads/' + patient.profile_image + '" alt="profile_image" style="width: 100px; height: 70px;"></td>';
                        row += '<td>' + patient.date_of_birth + '</td>';
                        row += '<td>' + patient.city + '</td>';
                        row += '<td>' + patient.price + '</td>';
                        row += '<td><a href="edit_patient.php?id=' + patient.id + '">Edit</a> | <a href="#" onclick="deletePatient(' + patient.id + ')">Delete</a></td>';
                        row += '</tr>';
                        $('#patientTableBody').append(row);
                    });
                } else {
                    $('#patientTableBody').append('<tr><td colspan="12">No records found</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax request failed:', status, error);
                console.log('Response:', xhr.responseText);
            }
        });
    }

    function fetchPagination() {
        $.ajax({
            url: 'fetch_pagination.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Pagination data:', data);

                $('#pagination').empty();

                for (var i = 1; i <= data.total_pages; i++) {
                    var pageLink = '<li><a href="#" onclick="fetchPage(' + i + ')">' + i + '</a></li>';
                    $('#pagination').append(pageLink);
                }
            },
            error: function(xhr, status, error) {
                console.error('Pagination request failed:', status, error);
                console.log('Response:', xhr.responseText);
            }
        });
    }

    function fetchPage(page) {
        fetchAllPatients(page);
    }

    window.fetchPage = fetchPage; 
    fetchAllPatients(1);
    fetchPagination();

    window.deletePatient = function(patientId) {
        console.log('Deleting patient with ID:', patientId);

        var confirmDelete = confirm("Are you sure you want to delete this patient?");

        if (confirmDelete) {
            $.ajax({
                url: 'delete_patient.php?id=' + patientId,
                type: 'GET',
                success: function(response) {
                    console.log('Patient deleted successfully.');
                    fetchAllPatients(); 
                },
                error: function(xhr, status, error) {
                    console.error('Ajax request failed:', status, error);
                    console.log('Response:', xhr.responseText);
                }
            });
        }
    };
});
