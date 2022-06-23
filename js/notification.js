function formatDate(date) {
    const d = new Date(date);
    const dayArray = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    const monthArray = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
    'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ]

    var dd = d.getDate();
    var mm = d.getMonth();
    var yyyy = d.getFullYear();

    return `${dayArray[d.getDay()]}, ${dd} ${monthArray[mm]} ${yyyy}`;
}

function createNotificationDrawer() {
    return `<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Colored with scrolling</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>Try scrolling the rest of the page to see this option in action.</p>
    </div>
</div>`
}

function createNotificationBox(date, status, body) {
    var color = '';

    if (status == 'Danger') {
        color = 'danger';
    } else if (status == 'Warning') {
        color = 'warning';
    } else if (status == 'Safe') {
        color = 'success';
    }

    return `<div class="d-flex border border-${color} m-2 align-items-center">
    <div class="ms-4 me-4">
        <span class="d-block bg-${color} rounded-circle" style="width: 50px; height: 50px;"></span>
    </div>
    <div class="align-items-center mt-3">
        <span class="fw-bold text-${color} text-uppercase">${formatDate(date)}</span>
        <p>${body}</p>
    </div>
</div>`
}

document.addEventListener('DOMContentLoaded', function () {
    const notificationBtn = $('#notification-btn');
    const notificationBtnFoot = $('#notification-bt-foot');

    function renderNotificationBtn (data) {
        notificationBtn.text(`${data.length} notifications`)
    }

    function renderNotificationBtnFoot (data) {
        notificationBtnFoot.text(`${data.length}`)
    }

    function renderNotificationContent (data) {
        data.map(d => {
            $('#notification-content').append(createNotificationBox(d.created_at, d.status, d.body))
        });
    }

    $.ajax('/api/notifications.json', {
        success: function (data) {
            renderNotificationBtn(data);
            renderNotificationBtnFoot(data);
            renderNotificationContent(data);
        }
    })
})

