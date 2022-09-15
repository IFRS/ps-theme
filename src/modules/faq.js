import List from 'list.js';

let faqList = new List('faq', {
  searchDelay: 500,
  listClass: 'faq__perguntas',
  valueNames: ['accordion-header'],
});

export { faqList }
