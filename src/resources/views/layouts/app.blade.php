<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>予定管理アプリ</title>
</head>
<body>
    @auth
        <div>
            ログイン中：{{ Auth::user()->name }}
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
    @endauth

    <hr>

    @yield('content')
    @stack('scripts')

    @if(Auth::check())
    <!-- 編集モーダル -->
    <div id="edit-modal" style="
        display: none;
        position: fixed;
        top: 30%; left: 50%; transform: translate(-50%, -30%);
        background: white; border: 1px solid #ccc; padding: 15px; z-index: 2000; width: 320px;
    ">
        <h4>メモ編集</h4>
        <form id="edit-form">
            <input type="text" id="edit-title" placeholder="タイトル" style="width:100%;"><br>
            <textarea id="edit-content" rows="5" style="width:100%; margin-top:5px;"></textarea><br>
            <button type="submit">保存</button>
            <button type="button" onclick="closeEditModal()">キャンセル</button>
        </form>
    </div>

    <!-- メモウィジェット -->
    <div id="note-wrapper" style="
        position: fixed; bottom: 20px; right: 20px;
        width: 320px; background: #f8f8f8; border: 1px solid #ccc;
        padding: 10px; z-index: 1000;">
        <strong>クイックメモ</strong>
        <div id="note-list" style="max-height: 150px; overflow-y: auto; margin-bottom: 10px;"></div>

        <form id="note-form">
            <input type="text" id="note-title" placeholder="タイトル" style="width:100%;" required><br>
            <textarea id="note-content" rows="3" style="width:100%;" placeholder="内容"></textarea><br>
            <button type="submit" style="width:100%; margin-top:5px;">追加</button>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const listEl = document.getElementById('note-list');
        const form = document.getElementById('note-form');
        const titleInput = document.getElementById('note-title');
        const contentInput = document.getElementById('note-content');

        const editModal = document.getElementById('edit-modal');
        const editTitle = document.getElementById('edit-title');
        const editContent = document.getElementById('edit-content');
        let editingNoteId = null;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function loadNotes() {
            fetch('/api/notes')
                .then(res => res.json())
                .then(notes => {
                    listEl.innerHTML = '';
                    notes.forEach(note => {
                        const div = document.createElement('div');
                        div.style.borderBottom = '1px solid #ddd';
                        div.style.marginBottom = '4px';

                        const contentDiv = document.createElement('div');
                        contentDiv.style.cursor = 'pointer';
                        contentDiv.innerHTML = `<strong>${note.title}</strong><br><small>${(note.content || '').slice(0, 30)}</small>`;
                        contentDiv.addEventListener('click', () => openEditModal(note));

                        const deleteBtn = document.createElement('button');
                        deleteBtn.textContent = '削除';
                        deleteBtn.style.fontSize = '10px';
                        deleteBtn.addEventListener('click', () => deleteNote(note.id));

                        div.appendChild(contentDiv);
                        div.appendChild(deleteBtn);
                        listEl.appendChild(div);
                    });
                });
        }

        function openEditModal(note) {
            editingNoteId = note.id;
            editTitle.value = note.title;
            editContent.value = note.content || '';
            editModal.style.display = 'block';
        }

        window.closeEditModal = function () {
            editingNoteId = null;
            editModal.style.display = 'none';
        }

        document.getElementById('edit-form').addEventListener('submit', function(e) {
            e.preventDefault();
            fetch(`/api/notes/${editingNoteId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    title: editTitle.value,
                    content: editContent.value
                })
            }).then(() => {
                closeEditModal();
                loadNotes();
            });
        });

        function deleteNote(id) {
            fetch(`/api/notes/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            }).then(() => loadNotes());
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            fetch('/api/notes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    title: titleInput.value,
                    content: contentInput.value
                })
            }).then(() => {
                titleInput.value = '';
                contentInput.value = '';
                loadNotes();
            });
        });

        loadNotes();
    });
    </script>
    @endif

</body>
</html>