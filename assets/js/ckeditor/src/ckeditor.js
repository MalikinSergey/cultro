/**
 * @license Copyright (c) 2014-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor.js';
import BlockQuote from '@ckeditor/ckeditor5-block-quote/src/blockquote.js';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold.js';
import Heading from '@ckeditor/ckeditor5-heading/src/heading.js';
import Image from '@ckeditor/ckeditor5-image/src/image.js';
import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle.js';
import ImageUpload from '@ckeditor/ckeditor5-image/src/imageupload.js';
import Indent from '@ckeditor/ckeditor5-indent/src/indent.js';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic.js';
import Link from '@ckeditor/ckeditor5-link/src/link.js';
import List from '@ckeditor/ckeditor5-list/src/list.js';
import MediaEmbed from '@ckeditor/ckeditor5-media-embed/src/mediaembed.js';
import PasteFromOffice from '@ckeditor/ckeditor5-paste-from-office/src/pastefromoffice';
import Table from '@ckeditor/ckeditor5-table/src/table.js';
import RemoveFormat from '@ckeditor/ckeditor5-remove-format/src/removeformat.js';
import Underline from '@ckeditor/ckeditor5-basic-styles/src/underline.js';
import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter.js';
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar.js';
import WordCount from '@ckeditor/ckeditor5-word-count/src/wordcount.js';
import FontSize from '@ckeditor/ckeditor5-font/src/fontsize.js';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials.js';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph.js';

export default class Editor extends ClassicEditor {}

// Plugins to include in the build.
Editor.builtinPlugins = [
	BlockQuote,
	Bold,
	Heading,
	Image,
	ImageStyle,
	ImageUpload,
	Indent,
	Italic,
	Link,
	List,
	MediaEmbed,
	PasteFromOffice,
	Table,
	RemoveFormat,
	Underline,
	SimpleUploadAdapter,
	ImageToolbar,
	WordCount,
	FontSize,
	Essentials,
	Paragraph
];

