<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('[data-toggle="collapse"]').click(function() {
        var $this = $(this);
        var $icon = $this.find('i');
        var $target = $($this.data('target'));

        $target.collapse('toggle');

        $target.on('show.bs.collapse', function() {
            $icon.removeClass('ti-plus').addClass('ti-minus');
        });

        $target.on('hide.bs.collapse', function() {
            $icon.removeClass('ti-minus').addClass('ti-plus');
        });
    });
});
</script>

<style>
@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}

.badgenew {
    background-color: #ff3b3b;
    color: white;
    border-radius: 5px; /* Rounded corners, but not a circle */
    padding: 5px 8px;
    font-size: 0.9em;
    font-weight: bold;
    min-width: 20px;
    display: inline-block;
    text-align: center;
    position: absolute;
    top: 5px;
    right: 10px;
    animation: pulse 1.5s infinite; /* Pulled from your existing CSS */
}

.badge {
    background-color: #ff3b3b;
    color: white;
    border-radius: 5px; /* Rounded corners, but not a circle */
    padding: 5px 8px;
    font-size: 0.9em;
    font-weight: bold;
    min-width: 20px;
    display: inline-block;
    text-align: center;
     
    top: 5px;
    right: 10px;
    animation: pulse 1.5s infinite; /* Pulled from your existing CSS */
}

.breadcrumb-item button {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    background-color: #4faef8;
    /* Cool blue background */
    border: none;
    /* Remove default button borders */
    border-radius: 10px;
    /* Rounded corners */
    color: white;
    /* White text */
    font-weight: bold;
    /* Make the text bold */
    font-size: 16px;
    /* Adjust font size */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Subtle shadow for 3D effect */
    cursor: pointer;
    /* Pointer cursor for interactivity */
    transition: background-color 0.3s, transform 0.2s;
    /* Smooth hover effects */
}

.breadcrumb-item button img {
    margin-right: 10px;
    /* Add space between the icon and text */
}

.breadcrumb-item button:hover {
    background-color: #3a8cc4;
    /* Slightly darker blue on hover */
    transform: scale(1.05);
    /* Slight zoom-in effect on hover */
}

.breadcrumb-item button:focus {
    outline: none;
    /* Remove focus outline */
}

</style>
