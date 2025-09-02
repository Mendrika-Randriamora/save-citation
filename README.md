# Save Citation Project

## Project Description

Save Citation is a web application built with PHP and SQLite that allows users to create, view, update, and delete citations or quotes. Each citation can include a title, author, description, an image, and the quote content itself. The application provides a user-friendly interface for managing citations, with image upload support and a visually appealing display using Bootstrap.

### Main Features

-   Add new citations with title, author, description, image, and quote
-   View detailed citation pages
-   Update or delete existing citations
-   Store images associated with each citation
-   Responsive design using Bootstrap

## Database Structure

The application uses a single SQLite table named `citations` to store all citation data. The table structure is as follows:

| Column | Type    | Description                                |
| ------ | ------- | ------------------------------------------ |
| id     | INTEGER | Primary key, auto-incremented              |
| title  | TEXT    | Title of the citation (required)           |
| author | TEXT    | Author of the citation (default: 'Unknow') |
| desc   | TEXT    | Description of the citation                |
| pict   | TEXT    | Path to the associated image file          |
| cite   | TEXT    | The citation/quote content                 |

### Table Definition

```sql
CREATE TABLE IF NOT EXISTS "citations" (
    "id"    INTEGER NOT NULL,
    "title" TEXT NOT NULL,
    "author" TEXT DEFAULT 'Unknow',
    "desc"  TEXT,
    "pict"  TEXT,
    "cite"  TEXT,
    PRIMARY KEY("id" AUTOINCREMENT)
);
```

-   **id**: Unique identifier for each citation.
-   **title**: The main title of the citation.
-   **author**: The author of the citation (can be left blank, defaults to 'Unknow').
-   **desc**: A short description of the citation.
-   **pict**: The file path to the image associated with the citation.
-   **cite**: The actual quote or citation text.

This structure allows flexible storage and easy retrieval of citation data for display and management in the application.
