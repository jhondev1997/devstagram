
const $element = document.querySelector('#name_page');


let date = new Date();
let monthFromDate = date.getMonth() + 1;
let dayFromDate = date.getDate();


const listCalendarEvents = [
  {
    month: "enero",
    monthNumber: 1,
    festivityDays: [
      {
        day: 1,
        style : 'text-red-600'
      }
    ]
  },
  {
    month: "julio",
    monthNumber: 7,
    festivityDays: [
      {
        day: 28,
        style: 'text-blue-500'
      }
    ]
  }
]

listCalendarEvents.map((element)=>{
  if( monthFromDate == element.monthNumber){

    element.festivityDays.map((element1)=>{

      if(dayFromDate == element1.day){

        $element.classList.toggle(element1.style)
      }
    })
  }
})



