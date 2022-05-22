<template>
    <div>
        <nav class="header">
            <div>
                <h1>PAST←TIME</h1>
                <span>~徒然と書く技術ブログ~</span>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'Header',
}
</script>

<style lang="scss" scoped>
    .header {
        background: linear-gradient(45deg, #1a0aef,#F89174 40%, #ef4848);
        background: -moz-linear-gradient(45deg, #1a0aef,#F89174 40%, #ef4848);
        background: -webkit-linear-gradient(45deg, #1a0aef,#F89174 40%, #ef4848);
        padding: 20px 25px;
        display: flex;
        h1 {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
            color: #fff;
        }
        span {
            color: #fff;
        }
    }
</style>
