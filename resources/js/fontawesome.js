/* Import the FontAwesome core */
import { library } from '@fortawesome/fontawesome-svg-core';

/* Import specific icons (add only what you need to reduce bundle size) */
import { faUser, faHome, faCog, faSearch, faCompass, faInbox, faBookmark, faUsers, faEllipsis, faSquareCaretLeft, faX, faHeart, faRetweet, faShareAlt } from '@fortawesome/free-solid-svg-icons';
import { faHeart as faRegularHeart, faComment, faBookmark as faRegularBookmark } from '@fortawesome/free-regular-svg-icons';

// Combine all icons into an object
const icons = {
    faUser,
    faHome,
    faCog,
    faSearch,
    faCompass,
    faInbox,
    faBookmark,
    faRegularBookmark,
    faUsers,
    faEllipsis,
    faSquareCaretLeft,
    faX,
    faHeart,
    faRegularHeart,
    faComment,
    faRetweet,
    faShareAlt
};

/* Add icons to the library */
library.add(...Object.values(icons));

export default library;