/* Import the FontAwesome core */
import { library } from '@fortawesome/fontawesome-svg-core';

/* Import specific icons (add only what you need to reduce bundle size) */
import { faUser, faHome, faCog, faSearch, faCompass, faInbox, faBookmark, faUsers, faEllipsis, faSquareCaretLeft, faX } from '@fortawesome/free-solid-svg-icons';

// Combine all icons into an object
const icons = {
    faUser,
    faHome,
    faCog,
    faSearch,
    faCompass,
    faInbox,
    faBookmark,
    faUsers,
    faEllipsis,
    faSquareCaretLeft,
    faX,
};

/* Add icons to the library */
library.add(...Object.values(icons));

export default library;