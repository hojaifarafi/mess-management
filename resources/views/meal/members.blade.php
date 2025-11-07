@extends('layouts.meal-settings')
@section('settings-content')
    <div class="w-5/6 mx-auto mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold mb-4">Members of {{ $meal->month }} {{ $meal->year }}</h2>
        <button onclick="openAddMemberModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add
            Member</button>
    </div>

    <table class="w-5/6 mx-auto bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-300 text-left dragging">S.No</th>
                <th class="py-2 px-4 border-b border-gray-300 text-left dragging">Name</th>
                <th class="py-2 px-4 border-b border-gray-300 text-left dragging">Email</th>
                <th class="py-2 px-4 border-b border-gray-300 text-left dragging">Short Name</th>
                <th class="py-2 px-4 border-b border-gray-300 text-left dragging">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr class="@if(!$loop->odd) bg-gray-50 @else bg-white @endif">
                    <td draggable="true" data-sl-no="{{ $member->sl_no }}" data-user-id="{{$member->user_id}}" class="py-2 px-4 border-b border-gray-300">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $member->user->name }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $member->user->email }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 cursor-pointer" ondblclick="editShortName(this)"
                        data-user-id="{{$member->user_id}}" title="Double click to edit">{{ $member->short_name }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">
                        <form action="{{ route('meal.member.remove', [$meal->id, $member->user_id]) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to remove this member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal for adding a new member -->
    <div id="addMemberModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">

        <!-- Modal Box -->
        <div class="bg-white w-1/3 rounded-2xl shadow-lg p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Add Member</h2>
                <button id="closeModalBtn" onclick="closeAddMemberModal()"
                    class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
            </div>
            <form id="addMemberForm" method="POST" action="{{ route('meal.member.store', $meal->id) }}">
                @csrf
                <input type="hidden" name="user_id" id="hiddenUserId">
                <!-- Search Input -->
                <div class="mb-4">
                    <input type="text" id="searchInput" placeholder="Search user by name..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <!-- field to take short name of the member -->
                <div class="mb-4 hidden" id="shortNameContainer">
                    <label for="short_name">Short Name <span class="text-red-700 text-xl">*</span></label>
                    <input type="text" id="shortNameInput" required placeholder="Enter short name for the member..."
                        name="short_name"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <span class="text-red-600 text-sm" id="shortNameError"></span>
                </div>

                <!-- Search Results -->
                <ul id="searchResults" class="max-h-40 overflow-y-auto space-y-2">
                    <!-- Dynamic search results appear here -->
                    {{-- <li class="p-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100"
          data-user-id="1" data-user-name="John Doe" ondblclick="selectMember(this)">John Doe (john@example.com)</li> --}}
                </ul>
            </form>
            <div class="mt-6 text-right hidden" id="addUserContainer">
                <button id="addUserBtn" onclick="submitMember(this)"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    Add Selected Member
                </button>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function closeAddMemberModal() {
            document.getElementById('addMemberModal').classList.add('hidden');
        }

        function openAddMemberModal() {
            document.getElementById('addMemberModal').classList.remove('hidden');
        }
        let userData = {
            id: null,
            shortName: ''
        };

        function selectMember(element) {
            userData.id = element.dataset.userId;
            document.getElementById('searchInput').value = element.dataset.userName;
            document.getElementById('searchInput').disabled = true;
            document.getElementById('searchResults').classList.add('hidden');
            document.getElementById('shortNameContainer').classList.remove('hidden');
            document.getElementById('shortNameInput').focus();
            document.getElementById('addUserContainer').classList.remove('hidden');
        }

        function submitMember(button) {
            userData.shortName = document.getElementById('shortNameInput').value;
            // Here you can add the code to actually add the member
            document.getElementById('hiddenUserId').value = userData.id;
            let shortName = document.getElementById('shortNameInput').value;
            let mealId = {{ $meal->id }};
            if (!shortName) {
                document.getElementById('shortNameError').innerText = 'Short name is required.';
                return;
            }
            fetch(`/meal/${mealId}/is-duplicate/${shortName}`)
                .then(response => response.json())
                .then(data => {
                    if (data.is_duplicate) {
                        document.getElementById('shortNameError').innerText =
                            'This short name is already taken. Please choose another one.';
                    } else {
                        document.getElementById('addMemberForm').submit();
                    }
                });
        }
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let query = this.value;
            let mealId = {{ $meal->id }};
            if (query.length < 2) {
                document.getElementById('searchResults').innerHTML = '';
                return;
            }
            fetch(`/meal/${mealId}/users/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let resultsContainer = document.getElementById('searchResults');
                    resultsContainer.innerHTML = '';
                    data.forEach(user => {
                        let li = document.createElement('li');
                        li.className =
                            'p-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100';
                        li.dataset.userId = user.id;
                        li.dataset.userName = user.name;
                        li.title = `Double click to select ${user.name}`;
                        li.ondblclick = function() {
                            selectMember(this);
                        };
                        li.innerText = `${user.name} (${user.email})`;
                        resultsContainer.appendChild(li);
                    });
                });
        });

        function closeAddMemberModal() {
            document.getElementById('addMemberModal').classList.add('hidden');
        }
        function editShortName(tdElement) {
            let currentShortName = tdElement.innerText;
            let userId = tdElement.dataset.userId;
            tdElement.contentEditable = true;
            tdElement.focus();
            tdElement.onblur = function() {
                let newShortName = tdElement.innerText.trim();
                if (newShortName === currentShortName || newShortName === '') {
                    tdElement.innerText = currentShortName;
                    tdElement.contentEditable = false;
                    return;
                }
                let mealId = {{ $meal->id }};
                fetch(`/meal/${mealId}/is-duplicate/${newShortName}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.is_duplicate) {
                            alert('This short name is already taken. Please choose another one.');
                            tdElement.innerText = currentShortName;
                        } else {
                            fetch(`/meal/${mealId}/members/${userId}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    short_name: newShortName
                                })
                            }).then(response => {
                                if (response.ok) {
                                    tdElement.innerText = newShortName;
                                } else {
                                    alert('Failed to update short name. Please try again.');
                                    tdElement.innerText = currentShortName;
                                }
                            });
                        }
                        tdElement.contentEditable = false;
                    });
            };
        }
        const draggables = document.querySelectorAll('td[draggable="true"]');
        let dragSrcEl = null;
        draggables.forEach(draggable => {
            draggable.addEventListener('dragstart', function(e) {
                dragSrcEl = this;
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/html', this.innerHTML);
            });

            draggable.addEventListener('dragover', function(e) {
                if (e.preventDefault) {
                    e.preventDefault();
                }
                e.dataTransfer.dropEffect = 'move';
                return false;
            });

            draggable.addEventListener('drop', function(e) {
                if (e.stopPropagation) {
                    e.stopPropagation();
                }
                if (dragSrcEl !== this) {
                    console.log(this.dataset.slNo);
                    let temp = this.innerHTML;
                    this.innerHTML = dragSrcEl.innerHTML;
                    dragSrcEl.innerHTML = temp;
                    // Here you can add code to update the order in the backend if needed
                    let mealId = {{ $meal->id }};
                    //let userId = dragSrcEl.dataset.userId;
                    fetch(`/meal/${mealId}/members-order`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            from_sl_no: dragSrcEl.dataset.slNo,
                            to_sl_no: this.dataset.slNo,
                            from_user_id: dragSrcEl.dataset.userId,
                            to_user_id: this.dataset.userId,
                        })
                    }).then(response => {

                        if (!response.ok) {
                            alert('Failed to update order. Please try again.');
                        }
                        window.location.reload();
                    });
                }
                return false;
            });
        });
    </script>
@endpush