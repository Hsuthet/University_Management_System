<div class="container mt-4">
    <div class="card shadow-sm border-0">
    <div class="card-header d-flex align-items-center bg-light">
    <!-- Title on the left -->
    <h5 class="mb-0 fw-bold">{{ $title }}</h5>

    <!-- Spacer to push the button to the right -->
    <div class="ms-auto">
        @if(!empty($addButton) && $addButton)
            <a href="{{ $addButtonLink ?? '#' }}" class="btn btn-primary btn-sm">+ Add</a>
        @endif
    </div>
</div>



        <div class="card-body">
            <!-- ✅ Responsive + Scrollable Table -->
            <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
                <table id="{{ $tableId ?? 'dataTable' }}" 
                       class="table table-bordered table-striped align-middle text-nowrap"
                       style="width: 100%; min-width: 1000px;">
                    <thead class="table-light">
                        <tr>
                            @foreach($columns as $key => $name)
                                <th class="text-nowrap">{{ $name }}</th> <!-- ✅ Prevent header wrap -->
                            @endforeach
                            @if(!empty($actionsColumn) && $actionsColumn)
                                <th class="text-nowrap">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-nowrap"> <!-- ✅ Prevent cell wrap -->
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DataTables CSS/JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<style>
  /* Header styling */
/* Header styling */
#{{ $tableId }} thead {
    background-color: #0d6efd; 
    color: white;
    font-weight: 600;
}

/* Row hover effect */
#{{ $tableId }} tbody tr:hover {
    background-color: #f1f5f9;
}
/* Table header */
#{{ $tableId }} thead {
    background-color: #f8f9fa; /* light gray */
    color: #212529;             /* dark text */
    font-weight: 600;
}

/* Row hover effect */
#{{ $tableId }} tbody tr:hover {
    background-color: #f1f3f5;  /* subtle hover */
}

/* Pagination buttons */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    background-color: transparent;
    color: #212529 !important;   /* dark text */
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    margin: 0 2px;
    padding: 2px 6px;
    font-weight: 500;
    font-size: 0.85rem;
    transition: all 0.15s ease-in-out;
}

/* Hover effect on pagination */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #dee2e6;
    color: #212529 !important;
}

/* Current page button */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #495057 !important; /* dark gray */
    color: #fff !important;
    font-weight: 600;
    font-size: 0.85rem;
}

/* Previous/Next buttons smaller */
.dataTables_wrapper .dataTables_paginate .paginate_button.previous,
.dataTables_wrapper .dataTables_paginate .paginate_button.next {
    padding: 2px 6px;
    font-size: 0.85rem;
}

/* Search input and length select */
.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_length select {
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 4px 8px;
    font-size: 0.875rem;
}

/* Table border and rounded corners */
.table-bordered {
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    overflow: hidden;
}

/* Search input and length select */
.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_length select {
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 5px 8px;
}



</style>

<script>
$(document).ready(function() {
    $('#{{ $tableId }}').DataTable({
        paging: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        searching: true,
        ordering: true,
        info: true,
        scrollX: true, // ✅ enables horizontal scroll
        autoWidth: false, // ✅ prevents weird column stretching
        language: {
            paginate: { previous: "<", next: ">" }  // simple arrows
        },
        columnDefs: [
            { orderable: false, targets: {{ $actionsColumn ? count($columns) : '[]' }} }
        ]
    });
});


</script>
