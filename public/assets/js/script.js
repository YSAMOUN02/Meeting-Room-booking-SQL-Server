window.onload = function() {
    // Hide the loading graphic and show the content once the page is fully loaded

    document.querySelector("#loading").style.display = 'none';

};



const token = localStorage.getItem("token");

async function validation_data(){

    let start_date = document.querySelector("#from_date");
    let end_date = document.querySelector("#to_date");
    let start_time = document.querySelector("#start_time");
    let end_time = document.querySelector("#end_time");

    let start_date_val = "NA";
    let end_date_val= "NA";
    let start_time_val= "NA";
    let end_time_val= "NA";
    let room_val = document.querySelector('#room').value;
    if(start_date){
        if(start_date.value != ''){
            start_date_val = start_date.value;
        }
    }
    if(end_date){
        if(end_date.value != ''){
            end_date_val = end_date.value;
        }
    }
    if(start_time){
        if(start_time.value != ''){
            start_time_val = start_time.value;
        }
    }
    if(end_time){
        if(end_time.value != ''){
            end_time_val = end_time.value;
        }
    }
    let tost = document.getElementById('toast');
    let label = document.querySelector("#hs-toast-warning-example-label");
    let btn_submit = document.querySelector("#btn_submit_booking");

    let total_time = 0;
    if (end_time_val !== 'NA' && start_time_val !== 'NA') {
        // Create Date objects with the same date but different times
        let startTime = new Date(`1970-01-01T${start_time_val}`);
        let endTime = new Date(`1970-01-01T${end_time_val}`);


            // Calculate the difference in milliseconds
            let diffInMs = endTime - startTime;

            // Convert milliseconds to hours
            total_time = diffInMs / (1000 * 60 * 60);

            // Limit total_time to two decimal places
            total_time = parseFloat(total_time.toFixed(2));

            if (start_time.classList.contains('fail_attemp')) {
                start_time.classList.remove('fail_attemp');
            }
            if (end_time.classList.contains('fail_attemp')) {
                end_time.classList.remove('fail_attemp');
            }


    }



    let message = '';
    daysSelected = -1;

    if (end_date_val != 'NA' && start_date_val != 'NA') {
        // Convert the date values to Date objects
        let startDate = new Date(start_date_val);
        let endDate = new Date(end_date_val);

        // Calculate the difference in time (milliseconds)
        let diffInMs = endDate - startDate;

        // Convert milliseconds to days
        daysSelected = diffInMs / (1000 * 60 * 60 * 24); // Converts to days


    }


    let start_null = 0;
    // Null Start Date Prevention
    if(start_date_val == 'NA'){
            message += '- Start Date is Invalid.<br>';

            if (!start_date.classList.contains('fail_attemp')) {
                start_date.classList.add('fail_attemp');
            }
            start_null = 1;
    }else{
        if (!start_date.classList.contains('fail_attemp')) {
            start_date.classList.remove('fail_attemp');
        }
            start_null = 0;
    }

    let end_null = 0;
    // Null End  Date Prevention
    if(end_date_val == 'NA'){
            message +=  '- End Date is Invalid.<br>';
            if (!end_date.classList.contains('fail_attemp')) {
                end_date.classList.add('fail_attemp');
            }
            end_null = 1;
   }else{
            if (!end_date.classList.contains('fail_attemp')) {
                end_date.classList.remove('fail_attemp');
            }
            end_null = 0;
   }

   let time_start_null = 0;
      // Null Start Time Prevention
   if(start_time_val == 'NA'){
            message +=  '- Start Time is Invalid.<br>';
            if (!start_time.classList.contains('fail_attemp')) {
                start_time.classList.add('fail_attemp');
            }
            time_start_null = 1;
    }else{
        if (!start_time.classList.contains('fail_attemp')) {
            start_time.classList.remove('fail_attemp');
        }
            time_start_null = 0;
    }

    let time_end_null = 0;
           // Null End Date Prevention
   if(end_time_val == 'NA'){
            message += '- End Time is Invalid.<br>';

            if (!end_time.classList.contains('fail_attemp')) {
                end_time.classList.add('fail_attemp');
            }
            time_end_null =1;
    }else{

            if (!end_time.classList.contains('fail_attemp')) {
                end_time.classList.remove('fail_attemp');
            }
            time_end_null = 0;
    }


    let zero_time = 0;
    // 0 Min Prevention
    if (total_time <= 0) {
        message += '- Time Invalid. 0 min Booking is not allowed.<br>';
        if (!start_time.classList.contains('fail_attemp')) {
            start_time.classList.add('fail_attemp');
        }
        if (!end_time.classList.contains('fail_attemp')) {
            end_time.classList.add('fail_attemp');
        }
        zero_time =1;
    } else {

        if (start_time.classList.contains('fail_attemp')) {
            start_time.classList.remove('fail_attemp');
        }
        if (end_time.classList.contains('fail_attemp')) {
            end_time.classList.remove('fail_attemp');
        }
        zero_time = 0;
    }

    let total_date = 0;
    if(daysSelected < 0){
        message += '- Date is invalid. Please select date Properly.';

        if (!start_date.classList.contains('fail_attemp')) {
            start_date.classList.add('fail_attemp');
        }
        if (!end_date.classList.contains('fail_attemp')) {
            end_date.classList.add('fail_attemp');
        }
        total_date  = 1;
    }else{
        if (start_date.classList.contains('fail_attemp')) {
            start_date.classList.remove('fail_attemp');
        }
        if (end_date.classList.contains('fail_attemp')) {
            end_date.classList.remove('fail_attemp');
        }
        total_date  = 0;
    }
    let bookable = 0;

    if(start_null == 0 && time_start_null  == 0  && time_end_null  == 0  && end_null == 0 && total_date ==0   && zero_time ==0){
        bookable = 1;
    }


    label.innerHTML = message;
    tost.style.display = 'block';
    btn_submit.style.backgroundColor = 'red';



    if(bookable == 1){
        let url = `/api/validation`;
        let data = await fetch(url, {
            method: "POST",
            headers: {
                Authorization: `Bearer ${token}`,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                start_date:start_date_val,
                end_date:end_date_val,
                start_time :start_time_val,
                end_time:end_time_val,
                room:room_val
            }),
        })
        .then((res) => res.json())
        .catch((error) => {
            alert(error);
        });
        if(data){
            console.log('bookable'+bookable + "data.bookable " + data.bookable);
                if(bookable == 1 && data.bookable == 1){
                    tost.style.display = 'none';
                    btn_submit.style.backgroundColor = 'blue';
                    btn_submit.setAttribute('type','submit');
                }else{

                    message +=  data.message;
                    label.innerHTML = ``;
                    label.innerHTML += message;
                    label.style.whiteSpace = 'wrap';
                    tost.style.display = 'block';
                    btn_submit.setAttribute('type','button');
                }
        }
    }else{
        btn_submit.setAttribute('type','button');
    }
}

function delete_id(id){
    let input = document.querySelector("#value_delete");
    if(input){
        input.value = id;
    }

}
let temp_index = 100;
function edit_user(index){
    if(index != temp_index){
        let fname = document.querySelector("#first_name");

        let company = document.querySelector("#company");
        let department = document.querySelector("#department");
        let role = document.querySelector("#role");
        let phone = document.querySelector("#phone");
        let id_card = document.querySelector("#id_card");
        let email = document.querySelector("#email");
        let user_login = document.querySelector("#user_login");
        let id = document.querySelector("#id");
        let password = document.querySelector("#password");
        if(id){
            id.value = users[index].id;
        }

        if(fname){
            fname.value = users[index].name;
        }
        if(company){
            company.value = users[index].company;
        }
        if(department ){
            department.value = users[index].department;
        }
        if(role){
            role.value = users[index].role;
        }
        if(phone){
            phone.value = users[index].phone;
        }
        if(id_card){
            id_card.value = users[index].id_card;
        }
        if(email){
            email.value = users[index].email;
        }
        if(user_login){
            user_login.value = users[index].user_login;
        }
        if(password){
            password.value = '';
        }
        temp_index = index;
    }
}
function edit_room(index){
    let name = document.querySelector("#name");
    let seat = document.querySelector('#seat');
    let description = document.querySelector("#description");
    let id = document.querySelector("#id");
    let thumbnail = document.querySelector("#thumbnail");
    if(id){
        id.value = room[index].id;
    }
    if(name){
        name.value = room[index].room_name??'';
    }
    if(seat){
        seat.value = room[index].seat??'';
    }
    if(description){
        description.value = room[index].description??'';
    }
    console.log(room[index].thumbnail);
    if(thumbnail){
        let image = '/Uploads/'+room[index].thumbnail;
        thumbnail.setAttribute('src',image);
    }
}
var state_password_show = 0;
function show_password() {
    if (state_password_show == 0) {
        document.querySelector("#password").setAttribute("type", "text");
        state_password_show++;
    } else {
        document.querySelector("#password").setAttribute("type", "password");
        state_password_show = 0;
    }
}
var state_password_show = 0;
function show_password2() {
    if (state_password_show == 0) {
        document.querySelector("#password2").setAttribute("type", "text");
        state_password_show++;
    } else {
        document.querySelector("#password2").setAttribute("type", "password");
        state_password_show = 0;
    }
}

function show_schedule(day,month,year){
    let schedule_show = document.querySelector("#schedule_show");
    let state_qty = 0;
    schedule_show.innerHTML = ``;
    book_data.map((item)=>{

        const inputDate = item?.date;
        const [yearBook, monthBook, dayBook] = inputDate.split("-");
        // console.log("day: "+dayBook +"Month: "+ monthBook + 'Year: ' + year);
        if( month == monthBook  && day == dayBook && year == yearBook ){
            state_qty++;
            const dateStr = item.date;
            const date = new Date(dateStr);
            const formattedDate = date.toLocaleDateString('en-GB', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
            });
            const formattedStartTime = formatTime(item.start_time);
            const formattedEndTime = formatTime(item.end_time);

            schedule_show.innerHTML += `


                        <li class="mb-10 ms-6 ">
                            <span
                                class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">
                                ${item.meeting_type } (${item.department })
                            </h3>
                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 ">
                                Topic : ${item.title }</h3>
                            <span
                                class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Booked
                                By: ${item.staff_name }</span>
                           <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                Meeting Date: ${formattedDate}
                            </time>
                            <time
                                class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Meeting
                                Time: ${formattedStartTime}
                                To ${formattedEndTime}</time>

                        </li>

        </ol>
            `;

        }

    })
    if(state_qty == 0){
        schedule_show.innerHTML = `
            <li class="mb-10 ms-6">
            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">No
                Booking Data <span
                    class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">Latest</span>
            </h3>
            </li>
        `;
    }
    ;
}
function formatTime(timeStr) {
    // Extract the HH:mm:ss part before any milliseconds
    const [time] = timeStr.split(".");
    const [hours, minutes, seconds] = time.split(":");

    // Create a Date object for formatting
    const date = new Date();
    date.setHours(hours, minutes, seconds);

    return date.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true, // Use 12-hour format with AM/PM
    });
}



async function search_user(no) {

    let other = document.querySelector("#type");
    let value = document.querySelector("#value");
    let type_val = "NA";
    let value_val = "NA";
    let page = 1;
    if(no != ''){
        page = no;
    }
    if (value) {
        if (value.value != "") {
            value_val = value.value;
        }
    }
    if (other) {
        type_val = other.value;
    }

    url = `/api/fect/user/data`;
    // Loading label
    document.querySelector("#loading").style.display = "block";

    let data = await fetch(url, {
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            type: type_val,
            value: value_val,
            page: page
        }),
    })
        .then((res) => res.json())
        .catch((error) => {
            alert(error);
        });
    if (data) {
        console.log(data);
        if (data.data) {
            if (data.data.length > 0) {
                let pagination_search = document.querySelector(
                    ".pagination_by_search"
                );
                if (pagination_search) {
                    pagination_search.style.display = "block";

                    if (data.page != 0) {
                        let page = data.page;
                        let totalPage = data.total_page;
                        let totalRecord = data.total_record;
                        render_pagination(page,totalPage,totalRecord);

                    }
                }
                let body_change = document.querySelector("#users_tbody");
                body_change.innerHTML = ""; // Clear the table body
                renderTableRows(data.data)
                users = data.data;
            } else {
                alert("Data not Found.");
            }
        } else {
            alert("Data not Found.");
        }
    } else {
        alert("Problem on database connection.");
    }
    document.querySelector("#loading").style.display = "none";
}
function renderTableRows(data) {
    const bodyChange = document.querySelector("#users_tbody");
    bodyChange.innerHTML = ""; // Clear the table body
    data.forEach((item, index) => {
        const row = `
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${index+1}</td>
                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">${item.id}</td>
                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">${item.name}</td>
                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">${item.id_card}</td>
                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">${item.company}</td>
                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">${item.department}</td>
                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">${item.email}</td>
                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">${item.role}</td>
                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">${item.phone}</td>
                <td class="hover_td px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                    <button type="button" onclick="update_user_via_search(${index})"  class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-4 py-1 text-center me-2 mb-2 md:px-5 md:py-2.5">
                        ${auth.role === "admin"
                            ? `<i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>`
                            : `<i class="fa-solid fa-eye" style="color: #ffffff;"></i>`
                        }
                    </button>
                    ${auth.role === "admin"
                        ? `<button type="button" onclick="delete_user_via_search(${item.id})" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-4 py-1 text-center me-2 mb-2 md:px-5 md:py-2.5">
                                <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                           </button>`
                        : ""
                    }

                </td>
            </tr>`;
        bodyChange.insertAdjacentHTML("beforeend", row);
    });
}

function render_pagination(page,totalPage,totalRecord )
{
    let total_user = document.querySelector("#total_user");
    if(total_user){
        total_user.textContent = 'Found '+totalRecord+' Users';
    }

    let pagination_search = document.querySelector(
        ".pagination_by_search"
    );
     // Start by building the entire HTML content in one go
     let paginationHtml = `

     <ul class="flex items-center -space-x-px h-8 text-sm">
     `;
            // Add the current page dynamically
            let left_val = page - 5;
            if (left_val < 1) {
            left_val = 1;
            }
            if (page != 1 && totalPage != 1) {
            paginationHtml += `
                    <li onclick="search_user(${
                        page - 1
                    })"  class="flex items-center justify-center px-1 h-4   lg:px-3 lg:h-8  md:px-1 md:h-4 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <i class="fa-solid fa-angle-left"></i>
                    </li>
                `;
            }
            let right_val = page + 5;
            if (right_val > totalPage) {
            right_val = totalPage;
            }
            for (let i = left_val; i <= right_val; i++) {
            if (i != page) {
                paginationHtml += `
                        <li onclick="search_user(${i})" class="flex items-center justify-center px-1 h-4   lg:px-3 lg:h-8  md:px-1 md:h-4 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                                ${i}
                        </li>
                    `;
            } else if (i == page) {
                paginationHtml += `
                        <li onclick="search_user(${i})" class="z-10 flex items-center justify-center px-1 h-4   lg:px-3 lg:h-8  md:px-1 md:h-4 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">

                                ${i}
                        </li>
                    `;
            }
            }
            if (page != totalPage) {
            paginationHtml += `
                    <li  onclick="search_user(${
                        page + 1
                    })" class="flex items-center justify-center px-1 h-4   lg:px-3 lg:h-8  md:px-1 md:h-4 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <i class="fa-solid fa-chevron-right"></i>
                    </li>
            `;
            }
            paginationHtml += `
            <li class="mx-2" style="margin-left:10px;">
                    <a href="1" aria-current="page"
                        class="z-10 flex items-center justify-center px-1 h-4   lg:px-3 lg:h-8  md:px-1 md:h-4 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                        <i class="fa-solid fa-filter-circle-xmark" style="color: #ff0000;"></i>
                    </a>
                </li>
                </ul>
            </div>
                `;
            // Finally, assign the full HTML to the element
            pagination_search.innerHTML = paginationHtml;
}

function close_div(div){
    if(div){
        document.querySelector('#'+div).style.display = 'none';
    }

}
function delete_user_via_search(id){
    let div_confirm = document.querySelector("#toast_search_delete");

    if(div_confirm){
        div_confirm.style.display = 'block';
        let input_id_delete = document.querySelector("#value_delete_via_search");
        if(input_id_delete){
            console.log(id);

            input_id_delete.value = id;
            console.log( input_id_delete.value );
        }
    }
}

function update_user_via_search(index){
    let div_confirm = document.querySelector("#toast_search_update");
    div_confirm.style.display = 'block';
    if(div_confirm){
        if(index != temp_index){

            let fname = document.querySelector("#first_name2");

            let company = document.querySelector("#company2");
            let department = document.querySelector("#department2");
            let role = document.querySelector("#role2");
            let phone = document.querySelector("#phone2");
            let id_card = document.querySelector("#id_card2");
            let email = document.querySelector("#email2");
            let user_login = document.querySelector("#user_login2");
            let id = document.querySelector("#id2");
            let password = document.querySelector("#password2");
            if(id){
                id.value = users[index].id;
            }

            if(fname){
                fname.value = users[index].name;
            }
            if(company){
                company.value = users[index].company;
            }
            if(department ){
                department.value = users[index].department;
            }
            if(role){
                role.value = users[index].role;
            }
            if(phone){
                phone.value = users[index].phone;
            }
            if(id_card){
                id_card.value = users[index].id_card;
            }
            if(email){
                email.value = users[index].email;
            }
            if(user_login){
                user_login.value = users[index].user_login;
            }
            if(password){
                password.value = '';
            }
            temp_index = index;
        }
    }
}
let same_search = 1;
function validation(){
    let input = document.querySelector("#value");
    let type = document.querySelector("#type");
    let type2 = document.querySelector("#type2");
    if(type){
        if(type.value == 'year'){
            input.setAttribute('type','number');
        }else{

            input.setAttribute('type','text');
        }
    }
    if(type){
        if(type2){
            if(type.value == type2.value){
                same_search = 1;
            }else{
                same_search = 0;
            }
        }
    }

}
let state_more_search = 0;
function more_search(state){
    let input2 = document.querySelector("#hidden_search");
    let more_btn = document.querySelector("#more_button");
    if(state == 1){
        if(input2){
            state_more_search = 1;
            input2.style.display = 'block';
            more_btn.style.opacity = 0;

        }
    }else{
        if(input2){
            state_more_search = 0;
            more_btn.style.opacity = 1;
            input2.style.display = 'none';

        }
    }
}

// async function search_book_data(no) {

//     let other = document.querySelector("#type");
//     let value = document.querySelector("#value");

//     let other2 = document.querySelector("#type2");
//     let value2 = document.querySelector("#value2");

//     let type_val = "NA";
//     let value_val = "NA";

//     let type_val2 = "NA";
//     let value_val2= "NA";

//     let page = 1;
//     if(no != ''){
//         page = no;
//     }
//     if (value) {
//         if (value.value != "") {
//             value_val = value.value;
//         }
//     }
//     if (other) {
//         type_val = other.value;
//     }
//     if (value2) {
//         if (value2.value != "") {
//             value_val2 = value2.value;
//         }
//     }
//     if (other2) {
//         type_val2 = other2.value;
//     }

//     url = `/api/fect/booked/data`;
//     // Loading label
//     document.querySelector("#loading").style.display = "block";

//     let data;
//     if(state_more_search == 1){
//          data = await fetch(url, {
//             method: "POST",
//             headers: {
//                 Authorization: `Bearer ${token}`,
//                 "Content-Type": "application/json",
//             },
//             body: JSON.stringify({
//                 type: type_val,
//                 value: value_val,
//                 type2: type_val2,
//                 value2: value_val2,
//                 same_type: same_search,
//                 page: page
//             }),
//         })
//             .then((res) => res.json())
//             .catch((error) => {
//                 alert(error);
//         });
//     }else{
//         data = await fetch(url, {
//             method: "POST",
//             headers: {
//                 Authorization: `Bearer ${token}`,
//                 "Content-Type": "application/json",
//             },
//             body: JSON.stringify({
//                 type: type_val,
//                 value: value_val,
//                 type2: 'NA',
//                 value2: 'NA',
//                 page: page
//             }),
//         })
//             .then((res) => res.json())
//             .catch((error) => {
//                 alert(error);
//         });
//     }





//     if (data) {
//         console.log(data);
//         // if (data.data) {
//         //     if (data.data.length > 0) {
//         //         let pagination_search = document.querySelector(
//         //             ".pagination_by_search"
//         //         );
//         //         if (pagination_search) {
//         //             pagination_search.style.display = "block";

//         //             if (data.page != 0) {
//         //                 let page = data.page;
//         //                 let totalPage = data.total_page;
//         //                 let totalRecord = data.total_record;
//         //                 render_pagination(page,totalPage,totalRecord);

//         //             }
//         //         }
//         //         let body_change = document.querySelector("#users_tbody");
//         //         body_change.innerHTML = ""; // Clear the table body
//         //         renderTableRows(data.data)
//         //         users = data.data;
//         //     } else {
//         //         alert("Data not Found.");
//         //     }
//         // } else {
//         //     alert("Data not Found.");
//         // }
//     } else {
//         alert("Problem on database connection.");
//     }
//     document.querySelector("#loading").style.display = "none";
// }
