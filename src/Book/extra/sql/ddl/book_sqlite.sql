--
-- Creating a sample table.
--



--
-- Table Book
--
DROP TABLE IF EXISTS Book;
CREATE TABLE Book (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "title" TEXT NOT NULL,
    "author" TEXT NOT NULL,
    "img_link" TEXT,
    "book_link" TEXT
);
