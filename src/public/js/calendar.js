let currentDate = new Date();

function renderCalendar(date, events = []) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const tbody = document.getElementById('calendar-body');
    const monthYearLabel = document.getElementById('month-year');
    monthYearLabel.innerText = `${year}年 ${month + 1}月`;
    tbody.innerHTML = '';
    let row = document.createElement('tr');

    for (let i = 0; i < firstDay.getDay(); i++) {
        row.appendChild(document.createElement('td'));
    }

    for (let day = 1; day <= lastDay.getDate(); day++) {
        const cellDate = new Date(year, month, day);
        const td = document.createElement('td');
        td.innerHTML = `<strong>${day}</strong>`;

        const eventsForDay = events.filter(ev => {
            return new Date(ev.start_time).toDateString() === cellDate.toDateString();
        });

        eventsForDay.forEach(ev => {
            const p = document.createElement('p');
            p.innerText = ev.title;
            p.style.fontSize = '12px';
            p.style.margin = '0';
            p.onclick = () => openModal(ev);
            td.appendChild(p);
        });

        row.appendChild(td);

        if ((firstDay.getDay() + day) % 7 === 0 || day === lastDay.getDate()) {
            tbody.appendChild(row);
            row = document.createElement('tr');
        }
    }
}

function openModal(eventData) {
    document.getElementById('edit-id').value = eventData.id;
    document.getElementById('edit-title').value = eventData.title;
    document.getElementById('edit-description').value = eventData.description;
    document.getElementById('edit-start').value = eventData.start_time;
    document.getElementById('edit-end').value = eventData.end_time;
    document.getElementById('editModal').style.display = 'block';
    document.getElementById('modalBackdrop').style.display = 'block';
}

function closeModal() {
    document.getElementById('editForm').reset();
    document.getElementById('editModal').style.display = 'none';
    document.getElementById('modalBackdrop').style.display = 'none';
}

document.getElementById('editForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const start = document.getElementById('edit-start').value;
    const end = document.getElementById('edit-end').value;

    if (new Date(start) > new Date(end)) {
        alert('開始日は終了日より前である必要があります');
        return;
    }

    const id = document.getElementById('edit-id').value;
    const updatedData = {
        title: document.getElementById('edit-title').value,
        description: document.getElementById('edit-description').value,
        start_time: document.getElementById('edit-start').value,
        end_time: document.getElementById('edit-end').value,
    };

    fetch(`/api/schedules/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(updatedData),
        credentials: 'include'
    })
    .then(async res => {
        if (!res.ok) {
            const error = await res.json();
            alert(`更新に失敗しました: ${error.message || '不明なエラー'}`);
            return;
        }
        return res.json();
    })
    .then(res => {
        closeModal();
        loadEventsAndRender(); // カレンダー更新
    });
});

function changeMonth(offset) {
    currentDate.setMonth(currentDate.getMonth() + offset);
    loadEventsAndRender();
}

function loadEventsAndRender() {
    fetch(`/api/schedules?year=${currentDate.getFullYear()}&month=${currentDate.getMonth() + 1}`, {
        credentials: 'include'
    })
    .then(res => res.json())
    .then(data => {
        renderCalendar(currentDate, data);
    });
}

document.addEventListener('DOMContentLoaded', loadEventsAndRender);