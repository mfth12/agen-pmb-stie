// Import dayjs and locale using ES6 modules
import dayjs from 'dayjs';
import 'dayjs/locale/id';

// Set the locale globally
dayjs.locale('id');

// Make dayjs available globally for legacy code
window.dayjs = dayjs;

export default dayjs; 