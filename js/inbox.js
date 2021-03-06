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

function createInboxContent(date, body) {
    return `<div class="d-flex border m-2 align-items-center">
    <div class="ms-4 me-4">
        <span class="d-block border border-2" style="width: 50px; height: 50px;"></span>
    </div>
    <div class="align-items-center mt-3">
        <span class="fw-bold text-uppercase">${formatDate(date)}</span>
        <p>${body}</p>
    </div>
</div>`
}

document.addEventListener('DOMContentLoaded', function () {
    const inboxBtn = $('#inbox-btn');
    const inboxBtnFoot = $('#inbox-btn-foot');

    function renderInboxBtn (data) {
        inboxBtn.text(`${data.length} inbox`)
    }

    function renderInboxBtnFoot (data) {
        inboxBtnFoot.text(`${data.length}`)
    }

    function renderInboxContent (data) {
        data.map(d => {
            $('#inbox-content').append(createInboxContent(d.created_at, d.body))
        });
    }

    function renderInboxSidebarContent (data) {
        data.map(d => {
            $('#inbox-sidebar-content').append(createInboxContent(d.created_at, d.body))
        });
    }

    function inboxFilter(data) {
        $('#inbox-search-input').on('input', function() {
            var value = $(this).val().toLowerCase();

            const result = data.filter(d => {
                return d.body.toLowerCase().includes(value);
            })

            setTimeout(() => {
                $('#inbox-content').empty();
                renderInboxContent(result);
            }, 500)
        })
    }

    $.ajax('/api/inbox.json', {
        success: function (data) {
            renderInboxBtn(data);
            renderInboxBtnFoot(data);
            renderInboxSidebarContent(data);
            renderInboxContent(data);
            inboxFilter(data);
        }
    })
})