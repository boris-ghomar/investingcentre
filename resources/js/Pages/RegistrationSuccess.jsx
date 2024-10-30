import React from 'react';
import {Alert, Box, Button, Card, CardHeader, CardMedia, Container, Paper} from "@mui/material";
import {usePage} from "@inertiajs/inertia-react";
import {router} from "@inertiajs/react";

const RegistrationSuccess = () => {
    const {props: {loginUrl}} = usePage();

    const toLogin = () => {
        router.visit(loginUrl);
    };

    return (
        <Container maxWidth="sm">
            <Box className="custom-container">
                <Alert severity="success"
                       action={<Button color="success" variant="contained" size="small" onClick={toLogin}>Go to Login</Button>}>You have
                    been registered</Alert>
            </Box>
        </Container>
    );
}

export default RegistrationSuccess;
