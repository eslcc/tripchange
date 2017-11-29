# Tripchange

## Setup

1. Install PHP, MySQL, Composer, yarn.
1. `git clone https://github.com/eslcc/tripchange`
2. Create a local MySQL database
3. Copy `.env.example` to `.env` and put in settings
  *  Go to https://apps.dev.microsoft.com, create an app, put its ID as GRAPH_KEY, click "Create Password" and put the password in as GRAPH_SECRET. Click "Add Platform", select Web, and paste the GRAPH_REDIRECT from `.env` in the "Redirect URL" field.
4. `yarn && yarn run dev`
5. `php artisan serve`
