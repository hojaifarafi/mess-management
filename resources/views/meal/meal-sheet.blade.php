@extends('layouts.manage-meal')
@section('content')
<h1 class="text-2xl font-bold mb-1 text-center">Meal Sheet for {{ $meal->month }} {{ $meal->year }}</h1>
<table class="mx-auto w-fit">
    <tr class="header-row bg-blue-400 text-white">
        <th class="name-col">Name</th>
        <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th>
        <th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th>
        <th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th><th>29</th><th>30</th>
        <th>31</th>
        <th class="name-col">Total</th>
    </tr>
    @foreach ($mealdatas as $mealdata)
    <tr class="@if($loop->odd) bg-blue-50 @else bg-blue-100 @endif" data-user-id="{{$mealdata->user_id}}" >
        <td class="name-input" >{{$mealdata->short_name}}</td> 
        @foreach (range(1, 31) as $j)
            <td class="cell" id="s-{{$loop->parent->iteration}}-d-{{$j}}"
                onfocus="setCaretPosition(this, this.innerText.length)"
                >{{$mealdata->{'d_'.$j} == 0 ? '' : $mealdata->{'d_'.$j} }}</td>
        @endforeach
        <td class="total-cell" id="t-{{$loop->iteration}}"></td>
    </tr>
    @endforeach
</table>
@endsection
@push('styles')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, sans-serif;
    }
    th, td {
        border: 1px solid black;
        text-align: center;
        max-height: 50px; /* Adjust height as needed */
        overflow: hidden;
    }
    .cell{
        min-width:50px;
        max-width: 50px;
    }
    .cell:focus {
        outline-color: blue;
        border-radius: 0%;
    }
    .name-input{
        min-width:100px;
    }
    .total-cell{
        min-width: 80px;
    }
</style>
@endpush
@push('scripts')
<script>
    // document.querySelectorAll('.cell').forEach(element => {
    //     setCaretPosition(element, element.innerText.length)
    // });
    document.querySelectorAll('.cell').forEach(element => {
        element.contentEditable = true;
        element.addEventListener('keydown',function(event){
            let textContent = element.innerText;
            console.log(textContent); 
            console.log(event.key);
            const validKey = ['0','1','2','3','4','5','6','7','8','9','.','Backspace','Enter','ArrowUp','ArrowDown','ArrowLeft','ArrowRight'];
            if(validKey.includes(event.key)){
                if(textContent.length == 5 && event.key != 'Backspace' || (textContent.includes('.') && event.key == '.')){
                    event.preventDefault();
                }
                let splitId = element.id.split('-');
                if(event.key == 'ArrowLeft'){
                    event.preventDefault();
                    if(splitId[3] == '1'){
                        element.blur();
                    }else {
                        document.getElementById(`s-${splitId[1]}-d-${parseInt(splitId[3])-1}`).focus();
                    }
                }
                if(event.key == 'ArrowRight'){
                    event.preventDefault();
                    if(splitId[3] == '31'){
                        element.blur();
                    }else {
                        document.getElementById(`s-${splitId[1]}-d-${parseInt(splitId[3])+1}`).focus();
                    }
                }
                if(event.key == 'ArrowUp'){
                    event.preventDefault();
                    if(splitId[1] == '1'){
                        element.blur();
                    }else {
                        document.getElementById(`s-${parseInt(splitId[1])-1}-d-${splitId[3]}`).focus();
                    }
                }
                if(event.key == 'ArrowDown' || event.key == 'Enter'){
                    event.preventDefault();
                    let memberCount = {{$memberCount}};
                    if(splitId[1] == {{$memberCount}}){
                        document.getElementById(`s-1-d-${parseInt(splitId[3])+1}`).focus();
                    }else {
                        document.getElementById(`s-${parseInt(splitId[1])+1}-d-${splitId[3]}`).focus();
                    }
                }
            }else {
                event.preventDefault();
            }
        });
        element.addEventListener('blur',function(event){
            let mealId = {{$meal->id}};
            let userId = parseInt(element.parentElement.dataset.userId);
            let mealNumber = Number(element.innerText,2);
            let splitId = element.id.split('-');
            fetch(`/meal/${mealId}/update-meal-sheet`,{
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    userId : userId,
                    mealNumber : mealNumber,
                    date : parseInt(splitId[3])
                })
            }).then(response => {
                // response.json().then(data => {
                //     console.log(data.request);
                // });
                console.log(response.body)
            });
        });
    });
    function setCaretPosition(el, position) {
    el.focus(); // Focus the contenteditable element

    // Create a new range and selection
    const range = document.createRange();
    const sel = window.getSelection();

    // Handle text nodes
    if (el.childNodes.length > 0) {
        const textNode = el.childNodes[0];
        const offset = Math.min(position, textNode.textContent.length);
        range.setStart(textNode, offset);
        range.collapse(true);
        sel.removeAllRanges();
        sel.addRange(range);
    } else {
        // If the element is empty, just place caret at 0
        range.setStart(el, 0);
        range.collapse(true);
        sel.removeAllRanges();
        sel.addRange(range);
    }
}

</script>
@endpush